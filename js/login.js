let form = document.getElementById('formSignIn');
let email = document.getElementById('email');
let password = document.getElementById('password');
let alertFillAllField = document.getElementById('alertFillAllField');
let alertRegisterSuccess = document.getElementById('alertRegisterSuccess');

formSignIn.addEventListener('submit', (e) => {
  e.preventDefault();
  if (email.value == '' || password.value == '') {
    alertFillAllField.classList.remove('d-none');

    setTimeout(() => {
      alertFillAllField.classList.add('d-none');
    }, 3000);
  } else {
    alertFillAllField.classList.add('d-none');
  }
});
