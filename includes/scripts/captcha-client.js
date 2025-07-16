function onSubmit(token) {
  const button = document.getElementById("reg-submit");
  const form = document.getElementById("register-form");

  //Check form validity
  if (form.checkValidity()) {
    //Disable button
    button.textContent = "Loading...";
    button.disabled = true;
    //Delay form submission to allow for button coloring update
    setTimeout(() => {
      form.submit();
    }, 250);
  } else {
    grecaptcha.reset();
    form.reportValidity();
  }
}
