<?php
include "../includes/server.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $username = $_POST['name'];
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = $_POST['password'];
    $password = filter_var($password,  FILTER_SANITIZE_SPECIAL_CHARS);

    // Check if password is at least 8 characters long
    if (strlen($password) < 8) {
        echo '<div class="error">Password must be  8 characters or more.</div>';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute SQL statement to insert data into the table
        $stmt = $conn->prepare("INSERT INTO admin (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword); // "sss" indicates three string parameters

        // Check if the data is successfully inserted
        if ($stmt->execute()) {
            echo '<div  class="success">Data inserted successfully.</div>';
        } else {
            echo '<div  class="error">Error inserting data.</div>';
        }

        // Close the statement and database connection
        $stmt->close();
    }
} else {
    /*return if no  POST request was made
    header("Location: addAdmin.php");
    exit();*/
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
        }

        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form h2 {
            margin-top: 0;
            color: #004080;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #004080;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #002b5c;
        }
    </style>
</head>

<body>
    <?php include("admin_header.php"); ?>

    <div class="container">
        <form action="" method="POST">
            <h2>Insert Data</h2>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Insert">
        </form>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>

</html>