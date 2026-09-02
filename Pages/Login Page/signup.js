document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const password1Input = document.getElementById('password1');
    const password2Input = document.getElementById('password2');

    // Validate form on submit
    form.addEventListener('submit', function (event) {
        const username = usernameInput.value.trim();
        const email = emailInput.value.trim();
        const password = password1Input.value.trim();
        const confirmPassword = password2Input.value.trim();

        if (username === "" || email === "" || password === "" || confirmPassword === "") {
            alert("❗ Please fill in all necessary information.");
            event.preventDefault();
            return;
        }

        if (password !== confirmPassword) {
            alert("❗ Passwords must be the same.");
            event.preventDefault();
            return;
        }

    });
  
    // Smooth animation for login form
    const loginForm = document.querySelector(".login-form");
    loginForm.style.opacity = "0";
    loginForm.style.transform = "translateY(30px)";
    setTimeout(() => {
      loginForm.style.transition = "all 0.6s ease";
      loginForm.style.opacity = "1";
      loginForm.style.transform = "translateY(0)";
    }, 100);
  });
          document.getElementById('togglePassword1').addEventListener('click', function () {
            const passwordField = document.getElementById('password1');
            const icon = this;
            if (passwordField.type === 'password') {
              passwordField.type = 'text';
              icon.classList.remove('bi-eye-slash');
              icon.classList.add('bi-eye');
            } else {
              passwordField.type = 'password';
              icon.classList.remove('bi-eye');
              icon.classList.add('bi-eye-slash');
            }
          });
        
          // Toggle password visibility for the second input
          document.getElementById('togglePassword2').addEventListener('click', function () {
            const passwordField = document.getElementById('password2');
            const icon = this;
            if (passwordField.type === 'password') {
              passwordField.type = 'text';
              icon.classList.remove('bi-eye-slash');
              icon.classList.add('bi-eye');
            } else {
              passwordField.type = 'password';
              icon.classList.remove('bi-eye');
              icon.classList.add('bi-eye-slash');
            }
          });