function onSubmit(token) {
  const form = document.getElementById("register-form");
  if (form.checkValidity()) {
    form.submit();
  } else {
    grecaptcha.reset();
    form.reportValidity();
  }
}
