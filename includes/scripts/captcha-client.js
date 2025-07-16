function onSubmit(token) {
  const button = document.getElementById("reg-submit");
  const form = document.getElementById("register-form");

  //Disable button
  button.textContent = "Loading...";
  button.disabled = true;

  setTimeout(() => {
    button.textContent = "Submit →";
    button.disabled = false;
  }, 30000);

  //Check form validity
  if (form.checkValidity()) {
    form.submit();
  } else {
    grecaptcha.reset();
    form.reportValidity();
  }
}
