<?php
require_once dirname(__DIR__, 2) . '/config/session.php';
header('Cache-Control: no-store');
if (!appIsLoggedIn()) { header('Location: login.php'); exit; }
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Men's Day - Login</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="login.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="login-page d-flex">
      <!-- Left side -->
      <div
        class="left-side d-flex flex-column justify-content-start align-items-start p-5"
      >
        <img
          src="../images/menDayLogo.png"
          class="logo mb-5"
          alt="Men's Day Logo"
        />
        <div class="menu">
          <h6 class="text-white fw-bold mb-4">New Arrivals</h6>
          <ul class="list-unstyled text-white-50">
            <li class="mb-2">Tops</li>
            <li class="mb-2">Bottoms</li>
            <li class="mb-2">Outerwear</li>
            <li class="mb-2">Footwear</li>
            <li class="mb-2">Accessories</li>
          </ul>
        </div>
      </div>

      <!-- Right side -->
      <div
        class="right-side d-flex flex-column justify-content-center align-items-center"
      >
        <div class="login-form text-center">
          <h2 class="fw-bold text-white mb-2">MY ACCOUNT</h2>
          <p class="text-white-50 mb-4">Your account</p>

<p class="text-white">Signed in as <?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?></p>
<a class="text-white" href="/Pages/Landing%20Page/Landing%20Page%20Men%27s%20Day.php">Continue shopping</a>
<?php if (appIsAdmin()): ?><p><a class="text-white" href="/Pages/Admin%20Page/account_management.php">Account management</a></p><?php endif; ?>
<form action="logout.php" method="POST">
<input type="hidden" name="csrf_token" value="<?= htmlspecialchars(appCsrfToken(), ENT_QUOTES, 'UTF-8') ?>">
<button type="submit" class="btn btn-light rounded-pill px-5 py-2 mb-3">Sign out</button>
</form>
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
