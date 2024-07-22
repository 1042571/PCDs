<?php
include '../includes/count.php';
// Pagination configuration
$records_per_page = 10; // Number of records to display per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the offset for the SQL query
$offset = ($page - 1) * $records_per_page;


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Delete the record from the drugmanufacturer table
    $delete_manufacturer = $conn->prepare("DELETE FROM `drugmanufacturer` WHERE id =?");
    $delete_manufacturer->execute([$delete_id]);

    // Delete the record from the manufacturercontact table
    $delete_manufacturer_contact = $conn->prepare("DELETE FROM `manufacturercontact` WHERE author_id =?");
    $delete_manufacturer_contact->execute([$delete_id]);

    // Delete the records from the drugs table
    $delete_manufacturer_drug = $conn->prepare("DELETE FROM `drugs` WHERE author_id =?");
    $delete_manufacturer_drug->bindParam(1, $delete_id);
    $delete_manufacturer_drug->execute();
    // Fetch the image file name from the deleted records
    $fetch_drug_img = $delete_manufacturer_drug->fetch(PDO::FETCH_ASSOC);
    // Delete the image files from the server
    unlink("../resource/blogUploads/". $fetch_drug_img['image']);

    // Delete the records from the posts table
    $delete_manufacturer_post = $conn->prepare("DELETE FROM `posts` WHERE author_id =?");
    $delete_manufacturer_post->bindParam(1, $delete_id);
    $delete_manufacturer_post->execute();
    $fetch_post_img = $delete_manufacturer_post->fetch(PDO::FETCH_ASSOC);
    unlink("../resource/blogUploads/". $fetch_post_img['image']);
}
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

        button {
            background-color: #004080;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #002b5c;
        }
    </style>
</head>

<body>
    <?php
    include("admin_header.php");

    // Prepare and execute SQL statement to fetch drug information
    $stmt = $conn->prepare("SELECT * FROM drugmanufacturer");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    ?>
        <h1>All Manufacturers</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>Address</th>
                <th>KRA pin</th>
                <th>Account creation date</th>
                <th>Action</th>
            </tr>
            <?php
            while ($fetch_details = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $fetch_details['id']; ?></td>
                    <td><?= $fetch_details['name']; ?></td>
                    <td><?= $fetch_details['email']; ?></td>
                    <td><?= $fetch_details['phone']; ?></td>
                    <td><?= $fetch_details['address']; ?></td>
                    <td><?= $fetch_details['kraPin']; ?></td>
                    <td><?= $fetch_details['createdAt']; ?></td>
                    <td><a href="viewManufacturer.php?delete=<?= $fetch_details['id']; ?>" onclick="return confirm('Delete this account? All user related information will also be delete!')">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "<p class='error'>No Manufacturers in the database</p>";
        exit();
    }
    // Calculate total number of pages file from count.php
    $total_pages = ceil($totalManufacturer / $records_per_page);

    // Display pagination links
    if ($total_pages > 1) {
        echo "<div>Page: ";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='viewReports.php?page=$i'>$i</a> ";
        }
        echo "</div>";
    }

    include("../includes/footer.php");
    ?>
</body>

</html>