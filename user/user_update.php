<?php
include '../includes/server.php';
//session_start();

if (isset($_SESSION['user_id']) && ($_SESSION['user_name'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
  } else {
    $user_id = "";
    $user_name = "";
  }

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and validate input data
    $username = $_POST['username'];
    $username = filter_var($username,  FILTER_SANITIZE_SPECIAL_CHARS);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = $_POST['password'];
    $password = filter_var($password,  FILTER_SANITIZE_SPECIAL_CHARS);


    $confirmPassword = $_POST['confirmPassword'];
    $confirmPassword = filter_var($confirmPassword,  FILTER_SANITIZE_SPECIAL_CHARS);

    // Validate password and confirm password
    if (strlen($password) < 8) {
        echo '<div  class="error">password must be more than 8</div>';
    } elseif ($password !== $confirmPassword) {
        echo '<div  class="error">passwords do no match</div>';
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Update user information in the database
        $update_user = $conn->prepare("UPDATE `users` SET name = ?, email = ?, password = ? WHERE id =?");
        if ($update_user->execute([$username, $email, $hashedPassword, $user_id])) {
            echo "<p class='success'>User information updated successfully</p>";
        } else {
            echo "<p class='error'>Error updating user information.</p>";
        }
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
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .eyeicon {
            max-height: 30px;
            cursor: pointer;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>

<body>

    <?php
    include("user_header.php");
    ?>

    <div class="container">
        <h1>Update Profile page</h1>
        <form action="#" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="username" placeholder="<?php echo htmlspecialchars($user_name); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">New Password:</label>
            <div>
                <input type="password" id="password" name="password" required>
                <img src="../resource/eye.svg" class="eyeicon" id="eyeicon" title="Show Password">
            </div>

            <label for="confirmPassword">Confirm Password:</label>
            <div>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <img src="../resource/eye.svg" class="eyeicon" id="eyeicon1" title="Show Confirm Password">
            </div>
            <input type="submit" value="Update">
        </form>
    </div>

    <?php
    include("../includes/footer.php");
    ?>
</body>
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

</html>