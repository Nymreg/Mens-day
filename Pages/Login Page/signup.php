<!DOCTYPE html>
<html lang="en"> 
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Men's Day - Sign Up</title>
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
          <h2 class="fw-bold text-white mb-2">NEW MEMBER</h2>
          <p class="text-white-50 mb-4">Welcome</p>

          <form class="w-100" action="signup_conn_db.php" method="post">
            <div class="input-group mb-3">
              <span class="input-group-text bg-transparent border-0">
                <i class="bi bi-person text-white-50"></i>
              </span>
              <input
                type="text"
                class="form-control bg-transparent text-white border-0 border-bottom"
                placeholder="Enter Username"
                id="username"
                name = "username"
              />
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text bg-transparent border-0">
                  <i class="bi bi-envelope text-white-50"></i>
                </span>
                <input
                  type="text"
                  class="form-control bg-transparent text-white border-0 border-bottom"
                  placeholder="Enter Email"
                  id="email"
                  name = "email"
                />
              </div>
              <div class="input-group mb-4">
                <span class="input-group-text bg-transparent border-0">
                  <i class="bi bi-lock text-white-50"></i>
                </span>
                <input
                  type="password"
                  class="form-control bg-transparent text-white border-0 border-bottom"
                  placeholder="Enter Password"
                  id="password1"
                  name = "password1"
                />
                <span class="input-group-text bg-transparent border-0">
                  <i class="bi bi-eye-slash text-white-50" id="togglePassword1" style="cursor: pointer;"></i>
                </span>
              </div>
              
              <div class="input-group mb-4">
                <span class="input-group-text bg-transparent border-0">
                  <i class="bi bi-lock text-white-50"></i>
                </span>
                <input
                  type="password"
                  class="form-control bg-transparent text-white border-0 border-bottom"
                  placeholder="Confirm Password"
                  id="password2"
                  name ="password2"
                />
                <span class="input-group-text bg-transparent border-0">
                  <i class="bi bi-eye-slash text-white-50" id="togglePassword2" style="cursor: pointer;"></i>
                </span>
              </div>
              

              <a href="login.html">
                <button
                  type="submit"
                  class="btn btn-light rounded-pill px-5 py-2 mb-3"
                  id="submit"
                ><a href="#"></a>
                  Continue <i class="bi bi-arrow-right"></i>
                </button>
              

            <div class="text-white-50 mb-3">OR</div>

            <div class="d-flex justify-content-center gap-3 mb-4">
              <button class="btn btn-outline-light rounded-circle">
                <i class="bi bi-google"></i>
              </button>
              <button class="btn btn-outline-light rounded-circle">
                <i class="bi bi-facebook"></i>
              </button>
              <button class="btn btn-outline-light rounded-circle">
                <i class="bi bi-apple"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
      
    <script src="signup.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
