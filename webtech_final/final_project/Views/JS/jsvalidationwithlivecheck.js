function validatestudent() {
            let username = document.getElementById('username').value;
            let name = document.getElementById('name').value;
            let phoneNum = document.getElementById('phoneNum').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('confirmPassword').value;

            let errorMessages = [];

            if (!username) {
                errorMessages.push("Username is required.");
            }
            if (!name) {
                errorMessages.push("Name is required.");
            }
            if (!password) {
                errorMessages.push("Password is required.");
            }
            if (!/^[0-9]{11}$/.test(phoneNum)) {
                errorMessages.push("Invalid phone number format.");
            }
            if (!/\S+@\S+\.\S+/.test(email)) {
                errorMessages.push("Invalid email format.");
            }
            if (password.length > 10) {
                errorMessages.push("Password must be less than 10 characters.");
            }
            if (password !== confirmPassword) {
                errorMessages.push("Passwords do not match.");
            }

            if (errorMessages.length > 0) {
                alert(errorMessages.join("\n"));
                return false;
            }
            else
            {
               alert("Registation Successfull.");
            }
            return true;
            }
function checkAvailability(field) {
var value = document.getElementById(field).value;
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
    document.getElementById(field + 'Availability').innerHTML = this.responseText;
}
};
xhttp.open("GET", "../Models/check_availability.php?field=" + field + "&value=" + value, true);
xhttp.send();
}