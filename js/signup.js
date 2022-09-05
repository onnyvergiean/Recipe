let form = document.getElementById('formSignUp');
let fullName = document.getElementById('fullName');
let email = document.getElementById('email');
let password = document.getElementById('password');
let confirmPassword = document.getElementById('confirmPassword');
let alertFillAllField = document.getElementById('alertFillAllField');
let alertRegisterSuccess = document.getElementById('alertRegisterSuccess');
let alertPasswordNotMatch = document.getElementById('alertPasswordNotMatch');

form.addEventListener('submit', (e) => {
  if (
    fullName.value == '' ||
    email.value == '' ||
    password.value == '' ||
    confirmPassword.value == ''
  ) {
    alertFillAllField.classList.remove('d-none');
    alertRegisterSuccess.classList.add('d-none');
    alertPasswordNotMatch.classList.add('d-none');
    setTimeout(() => {
      alertFillAllField.classList.add('d-none');
    }, 3000);
  } else if (password.value != confirmPassword.value) {
    alertPasswordNotMatch.classList.remove('d-none');
    alertRegisterSuccess.classList.add('d-none');
    alertFillAllField.classList.add('d-none');
    setTimeout(() => {
      alertPasswordNotMatch.classList.add('d-none');
    }, 3000);
  } else {
    alertFillAllField.classList.add('d-none');
    alertRegisterSuccess.classList.remove('d-none');
    alertPasswordNotMatch.classList.add('d-none');
  }
});
