document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    // Get values directly and safely from form elements
    const username = form.elements["username"].value.trim();
    const password = form.elements["password"].value;

    // Validate inputs
    if (!username || !password) {
      alert("❗ Please fill in both username and password.");
      return;
    }

    // Package the form data for the fetch request
    const formData = new FormData(form);

    // Send login request to the server
    fetch("login_conn_db.php", {
      method: "POST",
      body: formData,
    })
       .then(async (response) => {
        const body = await response.text();
        let data;
        try {
          data = JSON.parse(body);
        } catch {
          throw new Error("Unable to sign in right now. Please try again later.");
        }
        if (!data || typeof data.message !== "string" ||
            !["success", "error"].includes(data.status)) {
          throw new Error("Unable to sign in right now. Please try again later.");
        }
        if (!response.ok) {
          return { status: "error", message: data.message };
        }
        return data;
      })
      .then((data) => {
        if (data.status === "success") {
          alert(`✅ ${data.message}`);
          window.location.href = "../Landing Page/Landing Page Men's Day.php";
        } else {
          alert(`❗ ${data.message}`);
        }
      })
      .catch((error) => {
        // Never log server response bodies or submitted credentials.
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