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

  function readRememberedUsername() {
    try {
      return sessionStorage.getItem("login-locked-username");
    } catch {
      return null;
    }
  }

  function rememberUsername(username) {
    try {
      sessionStorage.setItem("login-locked-username", username);
    } catch {
      // The current-page countdown still works when browser storage is unavailable.
    }
  }

  function forgetRememberedUsername() {
    try {
      sessionStorage.removeItem("login-locked-username");
    } catch {
      // Lock enforcement remains server-side if browser storage is unavailable.
    }
  }

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

  function showAccountLockout(serverRemainingSeconds, username) {
    clearInterval(countdownTimer);
    lockedUsername = username.trim().toLowerCase();
    const lockDeadline = performance.now() + Math.max(0, serverRemainingSeconds) * 1000;
    rememberUsername(username);
    const render = () => {
      const remaining = Math.max(0, Math.ceil((lockDeadline - performance.now()) / 1000));
      if (remaining === 0) {
        feedback.textContent = "You may try logging in again.";
        lockedUsername = "";
        forgetRememberedUsername();
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

  async function parseResponse(response) {
    const body = await response.text();
    let data;
    try {
      data = JSON.parse(body);
    } catch {
      throw new Error("Unable to sign in right now. Please try again later.");
    }
    if (!data || (typeof data.message !== "string" &&
        data.status !== "status") ||
        !["success", "error", "status"].includes(data.status)) {
      throw new Error("Unable to sign in right now. Please try again later.");
    }
    return data;
  }

  usernameInput.addEventListener("input", updateSubmitState);

  const rememberedUsername = secureHandler
    ? readRememberedUsername()
    : null;
  if (rememberedUsername) {
    usernameInput.value = rememberedUsername;
    isCheckingLockout = true;
    updateSubmitState();
    const statusData = new FormData(form);
    statusData.set("action", "lockout_status");
    fetch(form.action, { method: "POST", body: statusData })
      .then(parseResponse)
      .then((data) => {
        isCheckingLockout = false;
        if (data.status !== "status") {
          feedback.textContent = "Unable to check the login lockout. Please try again.";
          updateSubmitState();
          return;
        }
        if (data.locked === true && Number.isInteger(data.remaining_seconds) &&
            data.remaining_seconds > 0) {
          showAccountLockout(data.remaining_seconds, rememberedUsername);
        } else {
          forgetRememberedUsername();
          lockedUsername = "";
          updateSubmitState();
        }
      })
      .catch(() => {
        isCheckingLockout = false;
        feedback.textContent = "Unable to check the login lockout. Please try again.";
        updateSubmitState();
      });
  }

  form.addEventListener("submit", async function (event) {
    event.preventDefault();
    if (isSubmitting ||
        (lockedUsername !== "" && usernameInput.value.trim().toLowerCase() === lockedUsername)) {
      return;
    }

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
      const data = await parseResponse(response);
      if (!response.ok) data.status = "error";
      if (data.status === "success") {
        alert(`✅ ${data.message}`);
        const destinations = [
          "/Pages/Admin%20Page/account_management.php",
          "/Pages/Landing%20Page/Landing%20Page%20Men%27s%20Day.php",
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
        if (data.lockout_type === "account" &&
            Number.isInteger(data.remaining_seconds)) {
          showAccountLockout(data.remaining_seconds, username);
        } else {
          showFeedback(message);
        }
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
