<?php
include 'includes/server.php';

session_start();
if (isset($_GET['log'])) {
    echo '<div  class="success">You can now login.</div>';
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a role is selected
    if (isset($_POST["role"])) {
        $role = $_POST["role"];

        $username = $_POST['username'];
        $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);

        $password = $_POST['password'];
        $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

        // Redirect based on the selected role
        // admin role
        if ($role == "admin") {
            $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
            // Bind the parameter $username to the prepared statement as a string type ("s").
            $select_admin->bind_param("s", $username);
            $select_admin->execute();
            $result_admin = $select_admin->get_result();
            $row_count = $result_admin->num_rows;

            if ($row_count > 0) {
                // Fetch the user's data
                $row = $result_admin->fetch_assoc();

                if (password_verify($password, $row['password'])) {
                    // Create session variables for the user
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_name'] = $username;
                    // Redirect to the user dashboard
                    header("Location: admin/admin_dash.php");
                    exit();
                } else {
                    echo '<div  class="error">Incorrect password.</div>';
                }
            } else {
                echo '<div  class="error">User not found.</div>';
            }
        }
        // manufacturers role
        elseif ($role == "manufacturer") {
            $select_manufacturer = $conn->prepare("SELECT * FROM `drugmanufacturer` WHERE name = ?");
            $select_manufacturer->bind_param("s", $username);
            $select_manufacturer->execute();
            $result_manufacturer = $select_manufacturer->get_result();
            $row_count = $result_manufacturer->num_rows;

            if ($row_count > 0) {
                $row = $result_manufacturer->fetch_assoc();

                if (password_verify($password, $row['password'])) {
                    $_SESSION['manufacturer_id'] = $row['id'];
                    $_SESSION['manufacturer_name'] = $username;
                    header("Location: manufacturer/manufacturer_dash.php");
                    exit();
                } else {
                    echo '<div  class="error">Incorrect password.</div>';
                }
            } else {
                echo '<div  class="error">User not found.</div>';
            }
        }
        // users role
        elseif ($role == "user") {
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE name = ?");
            $select_user->bind_param("s", $username);
            $select_user->execute();
            $result_user = $select_user->get_result();
            $row_count = $result_user->num_rows;

            if ($row_count > 0) {
                $row = $result_user->fetch_assoc();

                if (password_verify($password, $row['password'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $username;
                    header("Location: user/user_dash.php");
                    exit();
                } else {
                    echo '<div  class="error">Incorrect password.</div>';
                }
            } else {
                echo '<div  class="error">User not found.</div>';
            }
        }
        //user selected wrong role
        else{
            echo '<div class="error">Invalid role selected.</div>';
        }
    } else {
        echo '<div  class="error">Select role to proceed.</div>';
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
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        section {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 12px 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
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
            background-color: #0056b3;
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
            /*add a tick when user selects*/
            font-size: 18px;
            margin-left: 8px;
        }
    </style>
</head>

<body>
    <?php include("includes/header.php") ?>

    <section>
        <form action="" method="post">
            <div class="role-selection">
                <input type="radio" id="admin" name="role" value="admin">
                <label for="admin">Admin</label>
                <input type="radio" id="user" name="role" value="user">
                <label for="user">User</label>
                <input type="radio" id="manufacturer" name="role" value="manufacturer">
                <label for="manufacturer">Manufacturer</label>
            </div>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
            <p>Not a member? <a href="signup.php">Sign up</a></p>
        </form>
    </section>

    <?php include("includes/footer.php") ?>
</body>

</html>