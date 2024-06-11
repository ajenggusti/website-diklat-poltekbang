// document.addEventListener("DOMContentLoaded", function() {
//     document.getElementById("toggleCurrentPassword").addEventListener("click", function() {
//       var passwordField = document.getElementById("current_password");
//       var eyeIcon = document.getElementById("eye-icon-current");
//       if (passwordField.type === "password") {
//         passwordField.type = "text";
//         eyeIcon.classList.remove("bi-eye-slash");
//         eyeIcon.classList.add("bi-eye");
//       } else {
//         passwordField.type = "password";
//         eyeIcon.classList.remove("bi-eye");
//         eyeIcon.classList.add("bi-eye-slash");
//       }
//     });
  
//     document.getElementById("toggleNewPassword").addEventListener("click", function() {
//       var passwordField = document.getElementById("new_password");
//       var eyeIcon = document.getElementById("eye-icon-new");
//       if (passwordField.type === "password") {
//         passwordField.type = "text";
//         eyeIcon.classList.remove("bi-eye-slash");
//         eyeIcon.classList.add("bi-eye");
//       } else {
//         passwordField.type = "password";
//         eyeIcon.classList.remove("bi-eye");
//         eyeIcon.classList.add("bi-eye-slash");
//       }
//     });
  
//     document.getElementById("toggleNewPasswordConfirmation").addEventListener("click", function() {
//       var passwordField = document.getElementById("new_password_confirmation");
//       var eyeIcon = document.getElementById("eye-icon-confirm");
//       if (passwordField.type === "password") {
//         passwordField.type = "text";
//         eyeIcon.classList.remove("bi-eye-slash");
//         eyeIcon.classList.add("bi-eye");
//       } else {
//         passwordField.type = "password";
//         eyeIcon.classList.remove("bi-eye");
//         eyeIcon.classList.add("bi-eye-slash");
//       }
//     });
//   });


document.addEventListener("DOMContentLoaded", function() {
    function togglePasswordVisibility(toggleId, passwordId, iconId) {
        document.getElementById(toggleId).addEventListener("click", function() {
            var passwordField = document.getElementById(passwordId);
            var eyeIcon = document.getElementById(iconId);
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
    }

    togglePasswordVisibility("toggleCurrentPassword", "current_password", "eye-icon-current");
    togglePasswordVisibility("toggleNewPassword", "new_password", "eye-icon-new");
    togglePasswordVisibility("toggleNewPasswordConfirmation", "new_password_confirmation", "eye-icon-confirm");
    togglePasswordVisibility("toggleResetPassword", "password", "eye-icon-reset");
    togglePasswordVisibility("toggleResetPasswordConfirm", "password-confirm", "eye-icon-reset-confirm");
});
