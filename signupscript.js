document.addEventListener('DOMContentLoaded', () => {
    const signInBtnLink = document.querySelector('.signInBtn-link');
    const wrapper = document.querySelector('.wrapper');
  
    signInBtnLink.addEventListener('click', (event) => {
      event.preventDefault();
      window.location.href = "login.html";
    });
  });
  function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var eyeIcon = document.getElementById("eye");

    if (passwordField.type === "password") {
      passwordField.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      passwordField.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  }