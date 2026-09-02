document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    // Get form data
    const formData = new FormData(form);
    const username = formData.get("username");
    const password = formData.get("password");

    // Validate inputs
    if (!username || !password) {
      alert("❗ Please fill in both username and password.");
      return;
    }

    // Send login request to the server
    fetch("login_conn_db.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          alert(`✅ ${data.message}`);
          window.location.href = "../Landing Page/Landing Page Men's Day.php";
        } else {
          alert(`❗ ${data.message}`);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("❗ An error occurred. Please try again later.");
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
});
