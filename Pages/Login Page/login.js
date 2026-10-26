document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const feedback = document.querySelector("#login-feedback");
  let countdownTimer;

  function showFeedback(message) {
    clearInterval(countdownTimer);
    feedback.textContent = message;
  }

  function showCountdown(message, seconds) {
    clearInterval(countdownTimer);
    const deadline = performance.now() + Math.max(0, seconds) * 1000;
    const render = () => {
      const remaining = Math.max(0, Math.ceil((deadline - performance.now()) / 1000));
      const minutes = Math.floor(remaining / 60);
      const secondsPart = String(remaining % 60).padStart(2, "0");
      feedback.textContent = `${message} (${minutes}:${secondsPart} remaining)`;
      if (remaining === 0) clearInterval(countdownTimer);
    };
    render();
    countdownTimer = setInterval(render, 1000);
  }

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    // Get values directly and safely from form elements
    const username = form.elements["username"].value.trim();
    const password = form.elements["password"].value;

    // Validate inputs
    if (!username || !password) {
      showFeedback("Please fill in both username and password.");
      return;
    }

    // Package the form data for the fetch request
    const formData = new FormData(form);

    // Send login request to the server
    // PHP selects the form action; the default page always uses secure login.
    fetch(form.action, {
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
          return { ...data, status: "error" };
        }
        return data;
      })
      .then((data) => {
        if (data.status === "success") {
          alert(`✅ ${data.message}`);
          const destinations = [
            '/Pages/Admin%20Page/account_management.php',
            '/Pages/Landing%20Page/Landing%20Page%20Men%27s%20Day.php',
          ];
          window.location.href = destinations.includes(data.redirect)
            ? data.redirect
            : destinations[1];
        } else {
          const remainingAttempts = Number.isInteger(data.remaining_attempts)
            ? data.remaining_attempts
            : null;
          const message = remainingAttempts === null || remainingAttempts === 0
            ? data.message
            : remainingAttempts <= 2
              ? `Warning: ${remainingAttempts} login attempts remaining. ${data.message}`
              : `${data.message} ${remainingAttempts} attempts remaining.`;
          if (Number.isInteger(data.remaining_seconds)) {
            showCountdown(message, data.remaining_seconds);
          } else {
            showFeedback(message);
          }
        }
      })
      .catch((error) => {
        // Never log server response bodies or submitted credentials.
        showFeedback("An error occurred. Please try again later.");
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
