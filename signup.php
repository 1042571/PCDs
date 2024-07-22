    <?php

    include 'includes/server.php';

    session_start();

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if a role is selected
        if (isset($_POST["role"])) {
            $role = $_POST["role"];

            $username = $_POST['username'];
            $username = filter_var($username,  FILTER_SANITIZE_SPECIAL_CHARS);

            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $password = $_POST['password'];
            $password = filter_var($password,  FILTER_SANITIZE_SPECIAL_CHARS);

            $confirmPassword = $_POST['confirmPassword'];
            $confirmPassword = filter_var($confirmPassword,  FILTER_SANITIZE_SPECIAL_CHARS);

            //manufacturers inputs
            if ($role == "manufacturer") {
                $phoneNumber = $_POST['phoneNumber'];
                $phoneNumber = filter_var($phoneNumber, FILTER_SANITIZE_NUMBER_INT);

                $pinNumber = $_POST['pinNumber'];
                $pinNumber = filter_var($pinNumber,  FILTER_SANITIZE_SPECIAL_CHARS);

                $dateCreated = $_POST['dateCreated'];
                $dateCreated = filter_var($dateCreated,  FILTER_SANITIZE_SPECIAL_CHARS);

                $companyAddress = $_POST['companyAddress'];
                $companyAddress = filter_var($companyAddress,  FILTER_SANITIZE_SPECIAL_CHARS);
            }
            // checks if both users exists in the database before proceeding
            if ($role == "manufacturer") {
                // Check if manufacturer already exists based on email or username
                $check_manufacturer = $conn->prepare("SELECT * FROM `drugmanufacturer` WHERE email = ? OR name = ?");
                $check_manufacturer->execute([$email, $username]);
                if ($check_manufacturer->fetch()) {
                    echo '<div class="error">User with the same email or username already exists.</div>';
                }
            } else {
                // Check if user already exists based on email or username
                $check_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR name = ?");
                $check_user->execute([$email, $username]);
                if ($check_user->fetch()) {
                    echo '<div class="error">User with the same email or username already exists.</div>';
                }
            }


            // Check if password is at least 8 characters long
            if (strlen($password) < 8) {
                echo '<div class="error">Password must be  8 characters or more.</div>';
            }
            // Validate password and confirm password
            if ($password !== $confirmPassword) {
                echo '<div  class="error">password less then 8</div>';
            }
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database based on the role
            if ($role == "user") {
                $insert_user = $conn->prepare("INSERT INTO `users` (name, email, password) VALUES (?, ?, ?)");
                $insert_user->execute([$username, $email, $hashedPassword]);
                header("Location: login.php?log=success");
                exit();
            } elseif ($role == "manufacturer") {
                $insert_manufacturer = $conn->prepare("INSERT INTO `drugmanufacturer` (name, address, phone, email, kraPin, createdAt, password) VALUES (?,?,?,?,?,?,?)");
                $insert_manufacturer->execute([$username, $companyAddress, $phoneNumber, $email, $pinNumber, $dateCreated, $hashedPassword]);
                header("Location: login.php?log=success");
                exit();
            } else {
                echo '<div class="error">Invalid role selected.</div>';
            }
        } else {
            echo '<div class="error">Select appropriate role to continue.</div>';
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
                color: #333;
            }

            header {
                background-color: #333;
                color: #fff;
                padding: 20px;
                text-align: center;
            }

            section {
                max-width: 500px;
                margin: 50px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                color: #fff;
            }

            form {
                text-align: center;
            }

            label {
                display: block;
                margin: 10px 0;
                font-weight: bold;
            }

            input {
                width: 100%;
                padding: 10px;
                margin-bottom: 16px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
                display: flex;
                align-items: center;
            }

            .eyeicon {
                max-height: 30px;
                cursor: pointer;
            }

            input[type="submit"] {
                background-color: #007bff;
                color: #fff;
                cursor: pointer;
                border: none;
                border-radius: 4px;
                padding: 12px 20px;
                font-size: 16px;
                transition: background-color 0.3s ease;
            }

            input[type="submit"]:hover {
                background-color: #555;
            }

            .role-selection {
                text-align: center;
                margin-bottom: 20px;
            }

            .role-selection input[type="radio"] {
                display: none;
            }

            .role-selection label {
                display: inline-block;
                margin-right: 20px;
                padding: 10px 20px;
                border: 2px solid #007bff;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .role-selection label:hover {
                background-color: #007bff;
            }

            .role-selection input[type="radio"]:checked+label {
                background-color: #007bff;
                color: #fff;
            }

            .role-selection input[type="radio"]:checked+label::after {
                content: '\2713';
                font-size: 18px;
                margin-left: 8px;
            }

            .manufacturer-fields {
                display: none;
            }
        </style>
    </head>

    <body>

        <?php
        include("includes/header.php")
        ?>

        <section>
            <form action="" method="post">

                <!--users are required to select their role in the system for them to proceed-->
                <div class="role-selection">
                    <input type="radio" id="user" name="role" value="user">
                    <label for="user">User</label>

                    <input type="radio" id="manufacturer" name="role" value="manufacturer">
                    <label for="manufacturer">Manufacturer</label>
                </div>

                <!-- div will display fields when manufaturer radio button is selected-->
                <div class="manufacturer-fields">
                    <label for="companyAddress">Company Address:</label>
                    <input type="text" id="companyAddress" name="companyAddress">

                    <label for="phoneNumber">Phone Number:</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber">

                    <label for="pinNumber">KRA Pin Number:</label>
                    <input type="text" id="pinNumber" name="pinNumber">

                    <label for="dateCreated">Date Created:</label>
                    <input type="date" id="dateCreated" name="dateCreated">
                </div>


                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <div>
                    <input type="password" id="password" name="password" required>
                    <img src="resource/eye.svg" class="eyeicon" id="eyeicon" title="Show Password">
                </div>

                <label for="confirmPassword">Confirm Password:</label>
                <div>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                    <!--the title is used to show text when user hovers over it-->
                    <img src="resource/eye.svg" class="eyeicon" id="eyeicon1" title="Show Confirm Password">
                </div>

                <input type="submit" value="Sign Up">
                <p>Already a member? <a href="login.php">Log in</a></p>
            </form>
        </section>

        <?php
        include("includes/footer.php");
        ?>

        <script>
            let eyeicon = document.getElementById("eyeicon");
            let password = document.getElementById("password");
            let eyeicon1 = document.getElementById("eyeicon1");
            let password1 = document.getElementById("confirmPassword");
            let manufacturerFields = document.querySelector(".manufacturer-fields");

            eyeicon.onclick = function() {
                if (password.type == "password") { //checks if the password type is hidden
                    password.type = "text"; //displays password in text
                } else {
                    password.type = "password";
                }
            }

            eyeicon1.onclick = function() {
                if (password1.type == "password") {
                    password1.type = "text";
                } else {
                    password1.type = "password";
                }
            }
            //script to display and hide manufacturer div
            document.querySelectorAll('input[name="role"]').forEach((elem) => {
                elem.addEventListener("change", function(event) {
                    if (event.target.value === "manufacturer") {
                        manufacturerFields.style.display = "block";
                    } else {
                        manufacturerFields.style.display = "none";
                    }
                });
            });
        </script>

    </body>

    </html>