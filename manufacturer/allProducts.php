<?php
include_once "../includes/server.php";

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_post = $conn->prepare("DELETE FROM `drugs` WHERE id = ?");
    $delete_post->execute([$delete_id]);
    $fetch_post_img = $delete_post->fetch(PDO::FETCH_ASSOC);
    unlink("../resource/manufactureUploads/" . $fetch_post_img['image']);
}
// total number of records 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            text-align: center;
            background-color: #f5f5f5;
            color: #333;
        }

        h1 {
            color: #004080;
            margin-bottom: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #004080;
            color: #fff;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php
    include("manufacturer_header.php");

    // Prepare and execute SQL statement to fetch post information
    $stmt = $conn->prepare("SELECT * FROM drugs WHERE manufacturer_id = $user_id");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    ?>
        <h1>All | <?php echo $user_name; ?> | Products in the database</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Drug Name</th>
                <th>Active Agent</th>
                <th>Manufactured date</th>
                <th>Expiry date</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($fetch_details = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $fetch_details['id']; ?></td>
                    <td><a href="viewProduct.php?id=<?= $fetch_details['id']; ?>"><?= $fetch_details['name']; ?></a></td>
                    <td><?= $fetch_details['activeAgent']; ?></td>
                    <td><?= $fetch_details['manufacturingDate']; ?></td>
                    <td><?= $fetch_details['expiryDate']; ?></td>
                    <td>
                        <a href="allProducts.php?delete=<?= $fetch_details['id']; ?>" onclick="return confirm('Are you sure!')">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "<p class='error'>No Posted posts. Add some</p>";
        exit();
    }


    include("../includes/footer.php");
    ?>
</body>

</html>