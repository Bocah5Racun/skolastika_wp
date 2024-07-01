function onSubmit(token) {
  document.getElementById("register-form").submit();
  if (form.checkValidity()) {
    form.submit();
  } else {
    grecaptcha.reset();
    form.reportValidity();
  }
}
