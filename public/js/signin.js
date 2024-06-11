document.addEventListener("DOMContentLoaded", function() {
  document.querySelectorAll(".eye").forEach(button => {
    button.addEventListener("click", function() {
      const passwordField = this.previousElementSibling;
      const eyeIcon = this.querySelector(".eye-icon");
      if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("bi-eye-slash");
        eyeIcon.classList.add("bi-eye");
      } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("bi-eye");
        eyeIcon.classList.add("bi-eye-slash");
      }
    });
  });
});
