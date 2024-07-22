<?php
include_once '../includes/server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $msg = $_POST['message'];
    $msg = filter_var($msg, FILTER_SANITIZE_SPECIAL_CHARS);

    $userId = $_POST['userId'];

    // Prepare and execute SQL insert statement
    $insert_query = $conn->prepare("INSERT INTO `contact` (name, email, message, author_id) VALUES (?, ?, ?, ?)");
    $insert_query->bind_param("sssi", $name, $email, $msg, $userId);

    if ($insert_query->execute()) {
        // Insertion successful
        echo "<p class='success'>Message submitted successfully.</p>";
    } else {
        // Insertion failed
        echo "<p class='error'>Failed to submit message. Please try again later.</p>";
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

        section {
            padding: 40px 20px;
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        textarea {
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
    include("user_header.php")
    ?>

    <section>
        <form action="#" method="post">
            <input type="hidden" id="userId" name="userId" value="<?php echo $user_id; ?>">

            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" placeholder="<?php echo htmlspecialchars($user_name); ?>" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <input type="submit" value="Submit">
        </form>
    </section>

    <?php
    include("../includes/footer.php");
    ?>
</body>

</html>