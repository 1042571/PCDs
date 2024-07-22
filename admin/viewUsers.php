<?php
include '../includes/count.php';
include '../includes/server.php';

// Pagination configuration
$records_per_page = 10; // Number of records to display per pageF
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the offset for the SQL query
$offset = ($page - 1) * $records_per_page;

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_user->execute([$delete_id]);

    $delete_user_contact = $conn->prepare("DELETE FROM `contact` WHERE author_id = ?");
    $delete_user_contact->execute([$delete_id]);

    $delete_user_comments = $conn->prepare("DELETE FROM `comments` WHERE author_id = ?");
    $delete_user_comments->execute([$delete_id]);

    $delete_user_report = $conn->prepare("DELETE FROM `drugreport` WHERE author_id = ?");
    $delete_user_report->bind_param("i", $delete_id);
    $delete_user_report->execute();
    $fetch_report_img = $delete_user_report->fetch(PDO::FETCH_ASSOC);
    unlink("../resource/blogUploads/" . $fetch_report_img['image']);
}
?>
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
    $stmt = $conn->prepare("SELECT * FROM users  LIMIT ?, ?");
    $stmt->bind_param("ii", $offset, $records_per_page);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    ?>
        <h1>All Users</h1>

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
                    <td><a href="viewUsers.php?delete=<?= $fetch_details['id']; ?>" onclick="return confirm('Delete this account? All user related information will also be delete!')">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "<p class='error'>Add Products to the database</p>";
        exit();
    }
    // Calculate total number of pages
    $total_pages = ceil($totalUsers / $records_per_page);

    // Display pagination links
    if ($total_pages > 1) {
        echo "<div>Page: ";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='viewUsers.php?page=$i'>$i</a> ";
        }
        echo "</div>";
    }

    include("../includes/footer.php");
    ?>
</body>

</html>