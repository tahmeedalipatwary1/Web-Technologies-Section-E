<html>
<head>
    <title>Update Employer</title>  
  </head>
  <body>
  <form method="post" action="../Controller/EmployeRegCheck.php" enctype="multipart/form-data" name="Reg" onsubmit="return Form()">
        <fieldset>
            <legend><h2>Update_Employe</h2></legend>

            Employee Name:
            <input type="text" id="employee_Name" name="employee_Name" placeholder="Enter name" /><br><br>

            Company Name:
            <input type="text" id="company_Name" name="company_Name" placeholder="Enter Company Name" /><br><br>

            Contact Number:
            <input type="text" id="contactNum" name="Contact_Num" placeholder="Enter Contact Number" /><br><br>

            User Name:
            <input type="text" id="userName" name="UserName" placeholder="Enter your username" /><br><br>

            Password:
            <input type="password" id="password" name="Password" placeholder="Enter your password" /><br><br>

            Confirm Password:
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" /><br><br>

            <input type="submit" id="submitBtn" name="Submit" value="Submit"/>
        </fieldset>
    </form>
</body>
</html>


<script>
        function validName(name) {
            if (name === "") {
                alert('Name is required!');
                return false;
            }
            if (name.length < 2) {
                alert("Name must contain at least two words");
                return false;
            }

            for (let i = 0; i < name.length; i++) {
                let char = name[i];
                if (!(char >= 'a' && char <= 'z') && !(char >= 'A' && char <= 'Z')) {
                    alert("Invalid Name");
                    return false;
                }
            }
            return true;
        }

        function Company_Name(name) {
            if (name === "") {
                alert('Company Name is required!');
                return false;
            }
            if (name.length < 2) {
                alert("Company Name must have at least two words");
                return false;
            }

            for (let i = 0; i < name.length; i++) {
                let char = name[i];
                if (!(char >= 'a' && char <= 'z') && !(char >= 'A' && char <= 'Z')) {
                    alert("Invalid Company Name");
                    return false;
                }
            }
            return true;
        }

        function Phone(phone) {
            if (phone.trim() === "") {
                alert("Phone number is required");
                return false;
            } else if (phone.length !== 11 || isNaN(phone)) {
                alert("Phone number must be 11 digits");
                return false;
            }
            return true;
        }

        function validateUserName(name) {
            if (name.trim() === "") {
                alert("User name can't be empty");
                return false;
            }
            if (name.length < 2) {
                alert("User Name must contain at least two words");
                return false;
            }

            let firstChar = name[0];
            if (!(firstChar >= 'A' && firstChar <= 'Z') && !(firstChar >= 'a' && firstChar <= 'z')) {
                alert("UserName must start with a letter");
                return false;
            }

            for (let i = 0; i < name.length; i++) {
                let char = name[i];
                if (!((char >= 'A' && char <= 'Z') || (char >= 'a' && char <= 'z') || char === '.' || char === '_')) {
                    alert("Invalid character in the Username; can contain alphabets, periods, and underscores");
                    return false;
                }
            }
            return true;
        }

        function validatePassword(password) {
            if (password === "") {
                alert('Fill the password Properly');
                return false;
            }

            if (password.length <= 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            }

            let specialCharacters = ['@', '#', '$', '%'];
            let containsSpecialChar = false;

            for (let char of specialCharacters) {
                if (password.includes(char)) {
                    containsSpecialChar = true;
                    break;
                }
            }

            if (!containsSpecialChar) {
                alert("Password must contain at least one of the special characters (@, #, $, %).");
                return false;
            }

            return true;
        }

        function confirmpass(pass, cpass) {
            if (cpass === "") {
                alert("Confirm Password required");
                return false;
            } else if (pass !== cpass) {
                alert("Confirm password doesn't match");
                return false;
            }

            return true;
        }

        function Form() {
            let Name = document.getElementById('employee_Name').value;
            let C_Name = document.getElementById('company_Name').value;
            let userName = document.getElementById('userName').value;
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('confirmPassword').value;
            let phone = document.getElementById('contactNum').value;

            if (!validName(Name) ||
                !Company_Name(C_Name) ||
                !validateUserName(userName) ||
                !validatePassword(password) ||
                !confirmpass(password, confirmPassword) ||
                !Phone(phone)
            ) {
                return false;
            }

            return true;
        }
    </script>
