document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const feedback = document.querySelector("#login-feedback");
  const usernameInput = form.elements["username"];
  const submitButton = form.querySelector('button[type="submit"]');
  const secureHandler = new URL(form.action, window.location.href).pathname.endsWith("/login_conn_db.php");
  let countdownTimer;
  let lockedUsername = "";
  let isSubmitting = false;
  let isCheckingLockout = false;

  function formatTime(seconds) {
    const minutes = String(Math.floor(seconds / 60)).padStart(2, "0");
    const secondsPart = String(seconds % 60).padStart(2, "0");
    return `${minutes}:${secondsPart}`;
  }

  function updateSubmitState() {
    submitButton.disabled = isSubmitting || isCheckingLockout ||
      (lockedUsername !== "" && usernameInput.value.trim().toLowerCase() === lockedUsername);
  }

  function showFeedback(message) {
    clearInterval(countdownTimer);
    countdownTimer = undefined;
    feedback.textContent = message;
  }

  function rememberLockedUsername(username) {
    try {
      sessionStorage.setItem("login-locked-username", username);
    } catch {}
  }

  function forgetLockedUsername() {
    try {
      sessionStorage.removeItem("login-locked-username");
    } catch {}
  }

  function showLockout(seconds, username) {
    clearInterval(countdownTimer);
    lockedUsername = username.trim().toLowerCase();
    rememberLockedUsername(username);
    const deadline = performance.now() + Math.max(0, seconds) * 1000;
    const render = () => {
      const remaining = Math.max(0, Math.ceil((deadline - performance.now()) / 1000));
      if (remaining === 0) {
        feedback.textContent = "You may try logging in again.";
        lockedUsername = "";
        forgetLockedUsername();
        clearInterval(countdownTimer);
        countdownTimer = undefined;
      } else {
        feedback.textContent = `Too many failed login attempts. Please try again in ${formatTime(remaining)}.`;
      }
      updateSubmitState();
    };
    countdownTimer = setInterval(render, 1000);
    render();
  }

  async function readResponse(response) {
    const data = await response.json();
    if (!data || !["success", "error", "status"].includes(data.status)) {
      throw new Error("Invalid login response");
    }
    return response.ok ? data : { ...data, status: "error" };
  }

  async function checkRememberedLockout() {
    let rememberedUsername;
    try {
      rememberedUsername = sessionStorage.getItem("login-locked-username");
    } catch {
      return;
    }
    if (!secureHandler || !rememberedUsername) return;

    usernameInput.value = rememberedUsername;
    isCheckingLockout = true;
    updateSubmitState();
    try {
      const statusData = new FormData(form);
      statusData.set("action", "lockout_status");
      const response = await fetch(form.action, { method: "POST", body: statusData });
      const data = await readResponse(response);
      if (data.status === "status" && data.locked === true &&
          Number.isInteger(data.remaining_seconds) && data.remaining_seconds > 0) {
        showLockout(data.remaining_seconds, rememberedUsername);
      } else {
        forgetLockedUsername();
      }
    } catch {
      showFeedback("Unable to check the login lockout. Please try again.");
    } finally {
      isCheckingLockout = false;
      updateSubmitState();
    }
  }

  usernameInput.addEventListener("input", updateSubmitState);
  checkRememberedLockout();

  form.addEventListener("submit", async function (event) {
    event.preventDefault();
    if (isSubmitting) return;

    const username = usernameInput.value.trim();
    const password = form.elements["password"].value;
    if (!username || !password) {
      showFeedback("Please fill in both username and password.");
      return;
    }

    isSubmitting = true;
    updateSubmitState();
    try {
      const response = await fetch(form.action, {
        method: "POST",
        body: new FormData(form),
      });
      const data = await readResponse(response);
      if (data.status === "success") {
        alert(`✅ ${data.message}`);
        const destinations = [
          "/Pages/Admin%20Page/account_management.php",
          "/Pages/Landing%20Page/Landing%20Page%20Men%27s%20Day.php",
        ];
        window.location.href = destinations.includes(data.redirect)
          ? data.redirect
          : destinations[1];
        return;
      }

      if (Number.isInteger(data.remaining_seconds) && data.remaining_seconds > 0) {
        showLockout(data.remaining_seconds, username);
      } else if (Number.isInteger(data.remaining_attempts)) {
        showFeedback(`${data.message} ${data.remaining_attempts} attempts remaining.`);
      } else {
        showFeedback(data.message || "Unable to sign in right now. Please try again later.");
      }
    } catch {
      showFeedback("An error occurred. Please try again later.");
    } finally {
      isSubmitting = false;
      updateSubmitState();
    }

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
