document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("togglePassword").addEventListener("click", function() {
    var passwordField = document.getElementById("password");
    var eyeIcon = document.getElementById("eye-icon");
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

document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("togglePassword2").addEventListener("click", function() {
    var passwordField = document.getElementById("floatingPassword");
    var eyeIcon = document.getElementById("eye-icon");
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