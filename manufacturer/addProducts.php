<?php
include('../includes/server.php');
// Maximum allowed file size in bytes 
$max_file_size = 2 * 1024 * 1024; // 2MB

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data and filter input
    $fileName = $_POST['fileName'];
    $fileName = filter_var($fileName,  FILTER_SANITIZE_SPECIAL_CHARS);

    $activeAgent = $_POST['activeAgent'];
    $activeAgent = filter_var($activeAgent,  FILTER_SANITIZE_SPECIAL_CHARS);

    $drugBatch = $_POST['drugBatch'];
    $drugBatch = filter_var($drugBatch,  FILTER_SANITIZE_SPECIAL_CHARS);

    $manufacturerName = $_POST['manufacturerName'];
    $manufacturerName = filter_var($manufacturerName,  FILTER_SANITIZE_SPECIAL_CHARS);

    $drugDelivery = $_POST['drugDelivery'];
    $drugDelivery = filter_var($drugDelivery,  FILTER_SANITIZE_SPECIAL_CHARS);

    $manufacturingDate = $_POST['manufacturingDate'];
    $manufacturingDate = date('Y-m-d', strtotime($manufacturingDate));

    $expiryDate = $_POST['expiryDate'];
    $expiryDate = date('Y-m-d', strtotime($expiryDate));

    $manufacturerId = $_POST['manufacturerId'];

    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_destination = "../resource/manufactureUploads/" . $file_name;

    // Check file size
    if ($file_size > $max_file_size) {
        echo "<p class='error'>File size exceeds the maximum allowed limit of 2MB.</p>";
    }

    // Move uploaded file to destination
    elseif (move_uploaded_file($file_tmp, $file_destination)) {
        // Check if manufacturing date is before expiry date
        if (strtotime($manufacturingDate) >= strtotime($expiryDate)) {
            echo "<p class='error'>Manufacturing date must be before expiry date.</p>";
        } else {
            // Prepare SQL insert statement
            $sql = "INSERT INTO drugs (name, activeAgent, drugBatch, manufacturerName, image, drugDelivery, manufacturingDate, expiryDate, manufacturer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssssi", $fileName, $activeAgent, $drugBatch, $manufacturerName, $file_name, $drugDelivery, $manufacturingDate, $expiryDate, $manufacturerId);
            if ($stmt->execute()) {
                echo "<p class='success'>Drug information submitted successfully.</p>";
            } else {
                echo "<p class='error'>" . $conn->error . "</p>";
            }

            // Close statement
            $stmt->close();
        }
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
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
        input[type="date"],
        input[type="file"] {
            width: calc(100% - 20px);
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
    <div class="container">
        <h2>Drug registration Form</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="manufacturerId" name="manufacturerId" value="<?php echo $user_id; ?>">

            <label for="fileName">Drug Name:</label><br>
            <input type="text" id="fileName" name="fileName" required><br>

            <label for="activeAgent">Active Agent:</label><br>
            <input type="text" id="activeAgent" name="activeAgent" required><br>

            <label for="drugBatch">Drug Batch:</label><br>
            <input type="text" id="drugBatch" name="drugBatch" required><br>

            <label for="manufacturerName">Manufacturer Name:</label><br>
            <input type="text" id="manufacturerName" name="manufacturerName" placeholder="<?php echo htmlspecialchars($user_name); ?>" required><br>

            <label for="image">Image:</label><br>
            <input type="file" id="image" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required><br>

            <label for="drugDelivery">Drug Delivery:</label><br>
            <select id="drugDelivery" name="drugDelivery" required>
                <option value="">Select Drug Delivery</option>
                <?php
                // Fetch data from the 'delivery' table
                $delivery_query = "SELECT * FROM drugdelivery";
                $delivery_result = $conn->query($delivery_query);

                // Check if there are rows in the result set
                if ($delivery_result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $delivery_result->fetch_assoc()) {
                        // Set the option value to the 'delivery' column
                        echo "<option value='" . $row['delivery'] . "'>" . $row['delivery'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No delivery methods found</option>";
                }
                ?>
            </select><br>

            <label for="manufacturingDate">Manufacturing Date:</label><br>
            <input type="date" id="manufacturingDate" name="manufacturingDate" required><br>

            <label for="expiryDate">Expiry Date:</label><br>
            <input type="date" id="expiryDate" name="expiryDate" required><br>

            <input type="submit" value="Submit">
        </form>
    </div>
    <?php include("../includes/footer.php"); ?>
</body>

</html>