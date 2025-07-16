function onSubmit(token) {
  const button = document.getElementById("reg-submit");
  const loader = document.getElementById("reg-loader");
  const form = document.getElementById("register-form");

  //Check form validity
  if (form.checkValidity()) {
    button.style.display = "none";
    loader.style.display = "block";
    form.submit();
  } else {
    grecaptcha.reset();
    form.reportValidity();
  }
}
