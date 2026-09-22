"""Check Linux-case-sensitive repository paths and parse shipped JavaScript."""
from collections import Counter
from html.parser import HTMLParser
from pathlib import Path
import posixpath
import re
import subprocess
from urllib.parse import unquote, urlsplit

ROOT = Path(__file__).resolve().parents[1]
known = {p.relative_to(ROOT).as_posix() for p in ROOT.rglob('*') if p.is_file() and '.git' not in p.parts}
errors = []
scripts = 0
placeholders = 0
profiles = 0


def check_path(owner, url):
    url = url.strip()
    if not url or url.startswith(('#', 'http', 'data:', 'mailto:', 'tel:', 'javascript:')) or '${' in url:
        return
    path = unquote(urlsplit(url).path)
    target = path.lstrip('/') if path.startswith('/') else posixpath.normpath(posixpath.join(owner.parent.as_posix(), path))
    if target not in known:
        errors.append(f'{owner}: missing path {url}')


class Page(HTMLParser):
    def __init__(self, owner):
        super().__init__()
        self.owner = owner
        self.ids = []
        self.script = None
        self.blocks = []
        self.link = None

    def handle_starttag(self, tag, attributes):
        global placeholders, profiles
        a = dict(attributes)
        if a.get('id'):
            self.ids.append(a['id'])
        if a.get('href') == '#':
            placeholders += 1
        for attr in ('href', 'src', 'action'):
            if a.get(attr):
                check_path(self.owner, a[attr])
        if tag == 'a':
            self.link = a.get('href')
        if tag == 'img' and a.get('alt') == 'Profile':
            profiles += 1
            if self.link != '/Pages/Login%20Page/account.php':
                errors.append(f'{self.owner}: inconsistent profile link')
        if tag == 'script' and not a.get('src'):
            self.script = ''

    def handle_data(self, data):
        if self.script is not None:
            self.script += data

    def handle_endtag(self, tag):
        if tag == 'a':
            self.link = None
        if tag == 'script' and self.script is not None:
            self.blocks.append(self.script)
            self.script = None


for path in (ROOT / 'Pages').rglob('*'):
    if path.suffix not in ('.php', '.html', '.js', '.css'):
        continue
    owner = path.relative_to(ROOT)
    source = path.read_text(encoding='utf-8')
    if path.suffix in ('.php', '.html'):
        page = Page(owner)
        page.feed(re.sub(r'<\?php.*?\?>|<\?=.*?\?>', '', source, flags=re.S))
        for key, count in Counter(page.ids).items():
            if count > 1:
                errors.append(f'{owner}: duplicate id {key}')
        blocks = page.blocks
    else:
        blocks = [source] if path.suffix == '.js' else []
    for block in blocks:
        if not block.strip():
            continue
        result = subprocess.run(['node', '--check'], input=block.encode(), capture_output=True)
        scripts += 1
        if result.returncode:
            errors.append(f'{owner}: JavaScript syntax error')
        for url in re.findall(r'fetch\(\s*[\"\x27]([^\"\x27]+)', block):
            check_path(owner, url)
    if path.suffix == '.php':
        for depth, suffix in re.findall(r"require(?:_once)?\s+dirname\(__DIR__(?:, (\d+))?\) \. '([^']+)'", source):
            target = path.parent
            for _ in range(int(depth or 1)):
                target = target.parent
            if (target / suffix.lstrip('/')).relative_to(ROOT).as_posix() not in known:
                errors.append(f'{owner}: missing dirname include')
        for suffix in re.findall(r"require(?:_once)?\s+__DIR__ \. '([^']+)'", source):
            if (path.parent / suffix.lstrip('/')).relative_to(ROOT).as_posix() not in known:
                errors.append(f'{owner}: missing local include')
    if re.search(r'mysqli_connect\s*\(|new\s+mysqli\s*\(|localhost|127\.0\.0\.1|login_conn_db_unsecured\.php', source):
        errors.append(f'{owner}: obsolete connection/reference')

endpoints = list((ROOT / 'Pages').rglob('save_transaction.php'))
assert len(endpoints) == 25
assert all("'/config/checkout.php'" in p.read_text() for p in endpoints)
assert not errors, '\n'.join(errors)
print(f'PASS: static links/includes/fetch paths, {profiles} profile icons, {scripts} JavaScript files/blocks, 25 shared checkout endpoints')
print(f'Inventory: {placeholders} href="#" anchors remain (includes modal controls and placeholders).')
