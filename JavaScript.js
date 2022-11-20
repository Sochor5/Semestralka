function validateForm() {
    var emailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    var validEmail = document.getElementById("email").value.match(emailRegex);
    if (validEmail == null) {
        alert("Váš mail je chybný. Správny tvar: mail@domena.domena");
        return false;
    }
}