document.addEventListener('DOMContentLoaded', () => {
    const signUpBtnLink = document.querySelector('.signUpBtn-link');
    const wrapper = document.querySelector('.wrapper');
  
    signUpBtnLink.addEventListener('click', (event) => {
      event.preventDefault();
      window.location.href = "signup.html";
    });
  });
  function togglePasswordVisibility() {
      const passwordInput = document.getElementById('pwd');
      const eyeIcon = document.querySelector('.toggle-password i');
  
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      }
    }
  