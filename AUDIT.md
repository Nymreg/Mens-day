# Final functional audit

Audited the current main working tree, preserving the earlier fixes. No commit or
push was performed. Static review covered all PHP/HTML/JS/CSS application source,
SQL definitions, Docker/Apache configuration, runtime CA setup, and file paths.
Local HTTP tests use temporary synthetic sessions and deliberately remove all DB
environment variables; they never contact Aiven or expose account credentials.

## Confirmed issues and fixes

- All 36 Profile icons now reach one account gateway. Guests are redirected to
  login; members see a small account summary and POST logout using existing login
  styling. No pre-existing member account page or logout implementation existed.
- Nested product pages had incorrect relative login paths. Missing HTML category,
  store, Home/About and stylesheet targets were corrected where the intended
  existing file was unambiguous. Search/footer links with existing destinations
  were wired up. No static local attribute targets remain missing.
- Admin page and API previously allowed public access. Both now require a trusted
  numeric session user ID in ADMIN_USER_IDS. Public registration or renaming an
  account to "admin" cannot grant privileges. Admin writes require POST and CSRF.
- Account deletion previously matched username OR email and could remove multiple
  rows. It now uses one validated ID and rejects deleting the current account.
  Admin API errors are generic and never include raw SQL/driver details.
- The landing page had duplicate cart markup and duplicate carousel IDs. The
  accidental outer cart was removed and carousel IDs made unique.
- Signup/admin creation enforce the existing field-size limits and hash new
  passwords. Existing hash verification and exact plaintext migration remain.
- Checkout validated rows while inserting and could partially save malformed
  carts. All 25 endpoints now use one helper: validate the complete cart, then
  begin/commit a transaction and roll back on insertion errors. Existing text
  responses and transaction fields are retained.
- Search input now filters the category cards already on the page. Popular Tops
  cards link to the corresponding existing product-category pages.

## Additional findings in the final pass

- Eleven checkout promise chains still lacked a failure handler because their
  indentation differed. All now notify the user while retaining the cart on error.
- Login/signup lacked CSRF protection. Both forms now include tokens and both
  handlers verify them. Invalid login tokens do not clear an existing session.
- Session-dependent login/signup/landing output now uses no-store caching.
- Session startup now fails closed with a generic response and sets strict session
  IDs, HttpOnly cookies, and SameSite=Lax. Logout clears the cookie and session.
- Boolean/floating quantity values could be coerced into integers; checkout now
  requires an integer or integer string before positive-range validation.
- Admin rename could introduce duplicate usernames; conflicting renames now fail.
- Truthiness checks treated the valid username "0" as logged out. Shared explicit
  nonempty-string checks now preserve that account's session routing.
- Deployment notes incorrectly described the former unprotected admin system;
  they now document the allowlist and new-session requirement.

## Functions that appear correct

- Login uses the canonical shared Aiven connection and a prepared username lookup.
  Hash verification, migration before session creation, session-ID rotation, safe
  JSON errors, and the compatibility wrapper are preserved.
- Signup sends the exact backend keys and checks password confirmation without
  trimming/modifying passwords. No frontend calls the obsolete unsecured handler.
- Profile routing requires session state only at the gateway; static catalog
  pages do not need to start sessions just to link to that gateway.
- Account/admin queries use mens_daydb; checkout uses product. No new schema or
  localhost/root database connection was introduced.
- Verified TLS, diagnostic redaction, runtime certificate copy, Docker entrypoint,
  Apache restrictions, and document-root checks are unchanged.

## Known limitations and placeholders intentionally retained

- This is not a production payment/order system. Prices/coupons/totals still come
  from the browser, there is no authoritative clothing-price catalog, and guest
  checkout is accepted. An atomic write does not make those totals trustworthy.
  Transactions repeat the cart total on each row, as before. No payment capture,
  stock decrement, shipping, durable order identity, idempotency, or member/order
  association exists. Do not use this flow for financial settlement.
- Product carts are in memory on individual pages and disappear on navigation or
  reload. Landing-page cart/checkout and generic product-detail actions are
  prototypes, not a unified cross-page shopping cart. Resolving this requires an
  agreed cart/order design; attaching old unused scripts is not a safe fix.
- The standalone landing JavaScript/cart files contain older alternative cart
  implementations and references/selectors for a nonexistent cart page. They are
  not loaded by the current landing page and are left untouched.
- Hundreds of href="#" links remain: some are active modal/cart controls, others
  are intentional policy, story, gift-card, campaign, or marketing placeholders.
  Newsletter forms and social-login buttons have no backend integration. Generic
  product detail/recommendation buttons are not a complete purchase flow.
- Search filters displayed category cards only; it is not a full product search.
- There is no password-reset/email verification/rate-limiting feature. Truncated
  hashes and unsupported legacy passwords still need operator-assisted resets.
  Duplicate historical usernames remain possible; simultaneous registrations can
  race because username has no unique index. No schema change was made.
- Existing length checks conservatively count bytes, not Unicode characters.
- Sessions are filesystem-based, not shared across replicas. Account deletion or
  password changes do not centrally revoke every existing session; remove admin
  IDs from the environment allowlist when revoking admin access.
- The test suite does not prove live Aiven inserts, commit/rollback behavior,
  browser rendering, external CDN/image availability, or Render cookie persistence.

## Validation

- `python tests/functional_audit.py`: passed guest/member/admin access checks,
  forged is_admin flag rejection, admin CSRF, account redirects, logout, auth-form
  CSRF/cache behavior, safe missing-DB response, and all 25 invalid-cart endpoints.
- Recursive `php -l`: all 75 PHP files passed.
- `php tests/passwords.php`: all 10 checks passed.
- `python tests/static_audit.py`: passed Linux-case-sensitive local link/include/
  literal fetch target checks, 36 Profile icons, 32 JavaScript files/blocks, unique
  HTML IDs, and all 25 checkout wrappers. Dynamic template paths and external URLs
  require browser testing; this is not a full HTML validator.
- `git diff --check`: passed. Protected deployment/TLS files and SQL schemas have
  no audit changes. Docker/Apache and live Aiven were not executed locally.

## Render configuration

Keep DB_HOST, DB_PORT, DB_USER, DB_PASSWORD, DB_SSL_CA=/etc/secrets/ca.pem,
PORT=80, and the ca.pem secret unchanged. The existing entrypoint still exports
the readable runtime certificate path before starting Apache.

Set ADMIN_USER_IDS to comma-separated, existing, trusted numeric account IDs
(example: `11,25`, not usernames and not IDs chosen without verification).
Unset/empty grants no admin privileges. Obtain IDs privately with:

```sql
SELECT id, username FROM mens_daydb.users;
```

No manual database migration is required. Sign out/in after deployment so
existing sessions acquire user_id; reload forms for current CSRF tokens/scripts.

## Manual deployment checklist

1. As a guest, click Profile from Home, About, Store, Search, all five categories,
   and every nested product page: reach login, with no 404.
2. Register a test member with matching passwords; test mismatch, invalid email,
   duplicate account details, and overlong fields. Check successful redirect.
3. Log in by username. Check wrong password failure, unchanged whitespace in a
   valid password, and a known legacy account's one-time migration privately.
4. Navigate among pages and click Profile again: see account summary, not login.
   Refresh and open a new tab to check session persistence.
5. Sign out from Account. Profile should return to login. GET logout or an invalid
   token must not sign out an authenticated user.
6. As guest and normal member, open the admin page and API URLs directly; verify
   redirect/403. A member named admin must remain unauthorized.
7. As a configured admin, list/add/edit/delete a disposable account. Verify duplicate
   rename rejection, self-delete rejection, and missing-CSRF POST rejection.
8. Check Home/About/Store/Search/footer/category links, product cards, images,
   stylesheets, carousel behavior, and account links from nested pages on Linux.
9. Search category text and cancel; verify only relevant displayed cards remain.
10. On each of the 25 product pages, test add/remove/quantity, coupon application,
    cart open/close/Escape, Buy Now and checkout. Use disposable test transactions.
    Failed requests must preserve the cart and display an error.
11. In a safe test database, confirm multi-item checkout writes all rows together;
    force an insert failure to verify no partial rows remain. Test zero, negative,
    fractional, boolean and malformed quantities via the API without inspecting
    or sharing credentials. Confirm duplicate clicks remain a known limitation.
12. Verify Render startup still confirms the CA is readable, and ensure successful
    auth/checkout creates no new TLS errors or leaked credentials in responses.

## Readiness

Ready for review/commit and a controlled deployment of these fixes after configuring
ADMIN_USER_IDS. Not certified as production-ready commerce: the pricing/payment,
session-revocation, abuse-prevention, and cart limitations above remain. No commit
or push was performed.

Suggested commit: `Fix account navigation, authorization, and checkout validation`

## Exact working-tree file manifest

Each entry below describes the original defect and why the file changed.


| File | Defect / change / reason |
| --- | --- |
| `AUDIT.md` | Added the categorized final audit, known limitations, test evidence, deployment checklist and exact file manifest. |
| `DEPLOYMENT.md` | Replaced obsolete admin-security guidance and documented ADMIN_USER_IDS and post-deployment session/token refresh. |
| `Pages/About Us Page/About us.php` | Fix missing store targets and account/search/footer navigation. |
| `Pages/Admin Page/account_management.php` | Protect page server-side, expose session CSRF token for its JS, and correct profile/search navigation. |
| `Pages/Admin Page/admin_actions.php` | Protect all actions by admin identity/method/CSRF; delete by unique ID, prevent self-delete/duplicate rename, validate input and return safe errors. |
| `Pages/Admin Page/code.js` | Send CSRF header with API calls and delete by ID, matching protected server API. |
| `Pages/Landing Page/Landing Page Men's Day.php` | Use shared session/role checks and no-store; fix navigation; remove duplicate nested cart and assign unique carousel IDs. |
| `Pages/Login Page/account.php` | Added the missing session-aware account summary using existing login styling, so Profile does not return members to login. |
| `Pages/Login Page/login.php` | Redirect signed-in users to Account; add no-store and hidden CSRF token without altering layout. |
| `Pages/Login Page/login_conn_db.php` | Store stable user ID, derive role from trusted IDs, use shared session startup, verify CSRF and clear stale identity on login failure; preserve password/TLS behavior. |
| `Pages/Login Page/logout.php` | Added missing logout as a CSRF-protected POST that clears session data and cookie. |
| `Pages/Login Page/signup.php` | Start session and add no-store/hidden CSRF token to protect registration. |
| `Pages/Login Page/signup_conn_db.php` | Validate schema field lengths and CSRF before inserting hashed passwords; preserve TLS and registration response. |
| `Pages/Product Detail Page/ProDet.php` | Correct missing stylesheet and account/search/footer navigation; retain product-detail prototype. |
| `Pages/Search Page/search.js` | Add filtering/cancel behavior for existing category cards instead of decorative search input. |
| `Pages/Search Page/search.php` | Fix nonexistent category HTML links, account/search/About routes and inert category-card destinations. |
| `Pages/Store Page/Stores.php` | Correct stylesheet and account/search/footer navigation. |
| `Pages/subAccessories/Accessories Sub-Categories.php` | Correct Profile/search/footer and any unambiguous broken relative links. |
| `Pages/subAccessories/Belts Pages/Belts Page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subAccessories/Belts Pages/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subAccessories/Bracelet Products/Bracelet Page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subAccessories/Bracelet Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subAccessories/Hats Products/Hats Page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subAccessories/Hats Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subAccessories/Rings Products/Rings page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subAccessories/Rings Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subAccessories/Watches Pages/Watches Page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subAccessories/Watches Pages/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subBottoms/Bottoms Sub-Categories.php` | Correct Profile/search/footer and any unambiguous broken relative links. |
| `Pages/subBottoms/Chinos Products/Chinos page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subBottoms/Chinos Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subBottoms/Jeans Products/Jeans page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subBottoms/Jeans Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subBottoms/Shorts Products/Shorts page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subBottoms/Shorts Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subBottoms/Sweatpants Products/Sweatpants page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subBottoms/Sweatpants Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subBottoms/Trouser Products/Trouser page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subBottoms/Trouser Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subFootwear/Boots Products/Boots page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subFootwear/Boots Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subFootwear/Dress Shoes Products/Dress Shoes page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subFootwear/Dress Shoes Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subFootwear/Footwear Sub-Categories.php` | Correct Profile/search/footer and any unambiguous broken relative links. |
| `Pages/subFootwear/Sandals Products/Sandals page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subFootwear/Sandals Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subFootwear/Slippers Products/Slippers page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subFootwear/Slippers Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subFootwear/Sneakers Products/Sneakers page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subFootwear/Sneakers Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subOutwear/Blazer Products/Blazer page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subOutwear/Blazer Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subOutwear/Coats Products/Coats page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subOutwear/Coats Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subOutwear/Jackets Products/Jackets page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subOutwear/Jackets Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subOutwear/Outerwear Sub-Categories.php` | Correct Profile/search/footer and any unambiguous broken relative links. |
| `Pages/subOutwear/Raincoat Products/Raincoat page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subOutwear/Raincoat Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subOutwear/Vest Products/Vest page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subOutwear/Vest Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subTops/Hoodies Products/Hoodies page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subTops/Hoodies Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subTops/Polo Shirts Products/Polo Shirts page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subTops/Polo Shirts Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subTops/Shirts Products/Shirts page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subTops/Shirts Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subTops/Sweaters Products/Sweaters page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subTops/Sweaters Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `Pages/subTops/Tops Sub-Categories.php` | Correct Profile/search/footer and any unambiguous broken relative links. |
| `Pages/subTops/Tshirts Products/Tshirt page.php` | Correct Profile/search/footer and any unambiguous broken relative links. Ensure checkout failures notify the user and retain the cart. |
| `Pages/subTops/Tshirts Products/save_transaction.php` | Replace duplicated validation/partial-write implementation with the shared atomic checkout handler; preserve endpoint URL and response contract. |
| `config/checkout.php` | Added complete payload validation and atomic checkout writes with rollback and generic errors to prevent partial carts and malformed quantities. |
| `config/session.php` | Added shared session startup, strict/HttpOnly/SameSite cookies, explicit login-state checks, trusted-ID admin authorization, and CSRF utilities. |
| `tests/functional_audit.py` | Add isolated local HTTP regression coverage for auth/roles/CSRF/account/logout and all checkout validation endpoints without live database access. |
| `tests/static_audit.py` | Add repeatable case-sensitive link/include/fetch, Profile, duplicate-ID, JavaScript syntax and checkout-wrapper checks. |
