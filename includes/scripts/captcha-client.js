function onSubmit(token) {
  const button = document.getElementById("reg-submit");
  const form = document.getElementById("register-form");

  //Check form validity
  if (form.checkValidity()) {
    //Disable button
    button.textContent = "Loading...";
    button.disabled = true;
    form.submit();
  } else {
    grecaptcha.reset();
    form.reportValidity();
  }
}
