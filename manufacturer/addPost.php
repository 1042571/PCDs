<?php
include('../includes/server.php');
// Maximum allowed file size in bytes 
$max_file_size = 2 * 1024 * 1024; // 2MB

$role = "manufacturer";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $title = $_POST['title'];
    $title = filter_var($title,  FILTER_SANITIZE_SPECIAL_CHARS);

    $content = $_POST['content'];
    $content = filter_var($content,  FILTER_SANITIZE_SPECIAL_CHARS);

    $authorId = $_POST['authorId'];
    $authorName = $_POST['authorName'];

    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_destination = "../resource/blogUploads/" . $file_name;

    // Check file size
    if ($file_size > $max_file_size) {
        echo "<p class='error'>File size exceeds the maximum allowed limit of 2MB.</p>";
    }

    // Move uploaded file to destination
    elseif (move_uploaded_file($file_tmp, $file_destination)) {
        // Prepare SQL insert statement
        $sql = "INSERT INTO posts (title, content, author_name, image, role, author_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $title, $content, $authorName, $file_name, $role, $authorId);

        // Execute the query
        if ($stmt->execute()) { 
            echo "<p class='success'>Post inserted successfully.</p>";
        } else {
            echo "<p class='error'>" . $conn->error . "</p>";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "<p class='error'>Failed to upload image.</p>";
    }

    // Close database connection
    $conn->close();
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
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include("manufacturer_header.php"); ?>
    <h2>Add New Post</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="authorId" name="authorId" value="<?php echo $user_id; ?>">
        <input type="hidden" id="authorName" name="authorName" value="<?php echo $user_name; ?>">

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" required></textarea><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required><br>

        <input type="submit" value="Submit">
    </form>
    <?php include("../includes/footer.php"); ?>
</body>

</html>