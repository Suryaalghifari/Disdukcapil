document.addEventListener("DOMContentLoaded", () => {
  // Set current year in footer
  const yearElem = document.getElementById("current-year");
  if (yearElem) yearElem.textContent = new Date().getFullYear();

  // Tab switching functionality
  const tabBtns = document.querySelectorAll(".tab-btn");
  const tabPanes = document.querySelectorAll(".tab-pane");

  tabBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      tabBtns.forEach((b) => b.classList.remove("active"));
      tabPanes.forEach((p) => p.classList.remove("active"));
      this.classList.add("active");
      const tabId = this.getAttribute("data-tab");
      document.getElementById(`${tabId}-tab`).classList.add("active");
    });
  });

  // Password visibility toggle
  document.querySelectorAll(".toggle-password").forEach((btn) => {
    btn.addEventListener("click", function () {
      const input = this.parentElement.querySelector("input");
      const icon = this.querySelector("i");
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    });
  });

  // Floating label effect for all inputs
  document.querySelectorAll(".form-input").forEach((input) => {
    if (input.value) {
      const label = input.nextElementSibling;
      if (label && label.classList.contains("form-label")) {
        label.style.top = "0.5rem";
        label.style.fontSize = "0.75rem";
      }
    }
    input.addEventListener("input", function () {
      const label = this.nextElementSibling;
      if (label && label.classList.contains("form-label")) {
        if (this.value) {
          label.style.top = "0.5rem";
          label.style.fontSize = "0.75rem";
        }
      }
    });
  });

  // Shake animation on submit (error)
  document.querySelectorAll("form").forEach((form) => {
    form.addEventListener("submit", function () {
      this.classList.add("shake");
      setTimeout(() => {
        this.classList.remove("shake");
      }, 500);
    });
  });

  // Helper functions
  function showError(input, message) {
    input.classList.add("error");
    const errorElement = document.createElement("span");
    errorElement.className = "error-message";
    errorElement.textContent = message;
    input.parentElement.appendChild(errorElement);
  }

  function clearErrors() {
    document
      .querySelectorAll(".error")
      .forEach((el) => el.classList.remove("error"));
    document.querySelectorAll(".error-message").forEach((el) => el.remove());
  }

  function isValidEmail(email) {
    const re =
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
});

document.querySelectorAll(".tab-btn").forEach((btn) => {
  btn.addEventListener("click", function () {
    const tab = this.getAttribute("data-tab");
    // Ambil base URL sampai /auth
    let baseUrl = window.location.origin + window.location.pathname;
    // Hapus parameter jika ada
    baseUrl = baseUrl.split("?")[0];
    window.location.href = `${baseUrl}?tab=${tab}`;
  });
});
