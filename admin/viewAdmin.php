<?php
include '../includes/count.php';
// Pagination configuration
$records_per_page = 10; // Number of records to display per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the offset for the SQL query
$offset = ($page - 1) * $records_per_page;

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_user = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
    $delete_user->execute([$delete_id]);
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
    $stmt = $conn->prepare("SELECT * FROM admin");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    ?>
        <h1>All Admin</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            while ($fetch_details = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $fetch_details['id']; ?></td>
                    <td><?= $fetch_details['name']; ?></td>
                    <td><?= $fetch_details['email']; ?></td>
                    <td><a href="viewUsers.php?delete=<?= $fetch_details['id']; ?>" onclick="return confirm('Delete this account? The user related information will also be delete!')">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        //$message[] = 'No drug found with the specified Batch Number or lot code!';
        echo "<p class='error'>Add Products to the database</p>";
        //echo "<p><a href='addProducts.html'></a></p>";
        exit();
    }
    // Calculate total number of pages file from count.php
    $total_pages = ceil($totalAdmin / $records_per_page);

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