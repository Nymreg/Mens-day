"""Local HTTP checks; no real database, credentials, or live service is used."""
from pathlib import Path
import http.cookiejar
import json
import os
import re
import socket
import subprocess
import tempfile
import time
import urllib.error
import urllib.parse
import urllib.request

ROOT = Path(__file__).resolve().parents[1]


def run():
    env = dict(os.environ, ADMIN_USER_IDS="99")
    for key in ("DB_HOST", "DB_PORT", "DB_USER", "DB_PASSWORD", "DB_SSL_CA"):
        env.pop(key, None)
    with tempfile.TemporaryDirectory() as sessions:
        with socket.socket() as sock:
            sock.bind(("127.0.0.1", 0))
            port = sock.getsockname()[1]
        command = ["php", "-d", f"session.save_path={sessions}", "-d", "display_errors=0"]
        server = subprocess.Popen(command + ["-S", f"127.0.0.1:{port}", "-t", str(ROOT)],
                                  cwd=ROOT, env=env, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
        try:
            for _ in range(100):
                try:
                    with socket.create_connection(("127.0.0.1", port), timeout=.1):
                        break
                except OSError:
                    time.sleep(.05)
            class NoRedirect(urllib.request.HTTPRedirectHandler):
                def redirect_request(self, *args):
                    return None
            opener = urllib.request.build_opener(NoRedirect())

            def request(path, session=None, data=None, headers=None):
                url = f"http://127.0.0.1:{port}/" + urllib.parse.quote(path, safe="/?=&")
                hdr = dict(headers or {})
                if session:
                    hdr["Cookie"] = "PHPSESSID=" + session
                req = urllib.request.Request(url, data=data, headers=hdr)
                try:
                    res = opener.open(req, timeout=5)
                except urllib.error.HTTPError as error:
                    res = error
                return res.status, res.headers, res.read().decode()

            def seed(session, user_id, username='admin'):
                code = ("<?php session_id('" + session + "'); session_start(); "
                        "$_SESSION=['user_id'=>" + str(user_id) + ", 'username'=>'" + username + "', 'is_admin'=>true]; session_write_close();")
                subprocess.run(command, input=code.encode(), cwd=ROOT, env=env,
                               check=True, stdout=subprocess.DEVNULL, stderr=subprocess.PIPE)

            auth = "Pages/Login Page/"
            admin = "Pages/Admin Page/"
            assert request(auth + "account.php")[0] == 302
            assert request(admin + "admin_actions.php?action=list")[0] == 403
            seed("audit-normal", 1)
            seed("audit-admin", 99)
            seed("audit-zero", 2, '0')
            assert request(auth + "account.php", "audit-zero")[0] == 200
            assert request(admin + "account_management.php", "audit-normal")[0] == 403
            assert request(admin + "admin_actions.php?action=list", "audit-normal")[0] == 403
            assert request(admin + "account_management.php", "audit-admin")[0] == 200
            assert request(admin + "admin_actions.php?action=delete", "audit-admin", b'{"id":1}')[0] == 403
            status, _, body = request(auth + "account.php", "audit-normal")
            assert status == 200 and "Signed in as admin" in body
            assert request(auth + "login.php", "audit-normal")[0] == 302
            assert request(auth + "logout.php", "audit-normal")[0] == 403
            token = re.search(r'name="csrf_token" value="([a-f0-9]+)"', body)[1]
            assert request(auth + "logout.php", "audit-normal", ("csrf_token=" + token).encode(),
                           {"Content-Type": "application/x-www-form-urlencoded"})[0] == 303
            assert request(auth + "account.php", "audit-normal")[0] == 302
            form_headers = {"Content-Type": "application/x-www-form-urlencoded"}
            for handler in ["login_conn_db.php", "signup_conn_db.php"]:
                payload = b'username=test&email=test%40example.com&password=test&password1=test&password2=test'
                assert request(auth + handler, data=payload, headers=form_headers)[0] == 403
            for page, handler in [("login.php", "login_conn_db.php"), ("signup.php", "signup_conn_db.php")]:
                status, hdr, html = request(auth + page)
                assert status == 200 and hdr.get('Cache-Control') == 'no-store'
                session = re.search(r'PHPSESSID=([^;]+)', hdr.get('Set-Cookie'))[1]
                token = re.search(r'name="csrf_token" value="([a-f0-9]+)"', html)[1]
                payload = urllib.parse.urlencode({'csrf_token': token, 'username': 'test', 'email': 'bad',
                                                  'password': 'test', 'password1': 'test', 'password2': 'different'}).encode()
                status, _, body = request(auth + handler, session, payload, form_headers)
                assert status == (503 if page == 'login.php' else 400)
                if page == 'login.php':
                    assert json.loads(body)['message'] == 'Database temporarily unavailable.'
            bad_cart = json.dumps({"cart": [{"name": "Test", "color": "Black", "qty": 0}], "total_price": 10}).encode()
            for p in (ROOT / "Pages").rglob("save_transaction.php"):
                assert request(p.relative_to(ROOT).as_posix(), data=bad_cart,
                               headers={"Content-Type": "application/json"})[0] == 400
            bad_cart = json.dumps({"cart": [{"name": "Test", "color": "Black", "qty": True}], "total_price": 10}).encode()
            assert request('Pages/subTops/Tshirts Products/save_transaction.php', data=bad_cart,
                           headers={"Content-Type": "application/json"})[0] == 400
            print("PASS: guest/member/admin gates, forged admin flag denial, CSRF, account routing, logout, 25 checkout validation endpoints")
        finally:
            server.terminate()
            server.wait(timeout=10)


if __name__ == "__main__":
    run()
