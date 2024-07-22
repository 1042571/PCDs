<?php
include('../includes/server.php');
// Maximum allowed file size in bytes 
$max_file_size = 2 * 1024 * 1024; // 2MB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['name'];
    $userName = filter_var($userName, FILTER_SANITIZE_SPECIAL_CHARS);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $drugName = $_POST['drugName'];
    $drugName = filter_var($drugName, FILTER_SANITIZE_SPECIAL_CHARS);

    $issue = $_POST['issue'];
    $issue = filter_var($issue, FILTER_SANITIZE_SPECIAL_CHARS);

    $userId = $_POST['userId'];


    $file_name = $_FILES['image']['name']; //retrieves the original name of the uploaded file
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_destination = "../resource/userUploads/" . $file_name;

    // Check file size
    if ($file_size > $max_file_size) {
        echo "<p class='error'>File size exceeds the maximum allowed limit of 2MB.</p>";
    } elseif (move_uploaded_file($file_tmp, $file_destination)) {
        // Prepare SQL insert statement
        $sql = "INSERT INTO `drugreport` (email, drugName, description, image, author_name, author_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $email, $drugName, $issue, $file_name, $userName, $userId);

        // Execute the query
        if ($stmt->execute()) {
            echo "<p class='success'>Drug reported successfully.</p>";
            echo "<p class='error'>Please don't consume it!! Return to nearest pharmacy near you</p>";
        } else {
            echo "<p class='error'>" . $conn->error . "</p>";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "<p class='error'>Failed to upload image.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Non-Genuine Drug</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        h1 {
            color: #004080;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <?php
    include("user_header.php");
    ?>

    <h1>Report Non-Genuine Drug</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" id="userId" name="userId" value="<?php echo $user_id; ?>">

        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" placeholder="<?php echo htmlspecialchars($user_name); ?>" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="drugName">Drug Name:</label>
        <input type="text" id="drugName" name="drugName" required>

        <label for="issue">Description of the Issue:</label>
        <textarea id="issue" name="issue" rows="4" required></textarea>

        <label for="img">Upload Supporting Documents:</label>
        <input type="file" id="image" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required>

        <button type="submit">Submit Report</button>
    </form>

    <?php
    include("../includes/footer.php");
    ?>
</body>

</html>