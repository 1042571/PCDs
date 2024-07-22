<?php
include_once "../includes/server.php";

// Pagination configuration
$records_per_page = 10; // Number of records to display per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the offset for the SQL query
$offset = ($page - 1) * $records_per_page;

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_post = $conn->prepare("DELETE FROM `manufacturercontact` WHERE id = ?");
    $delete_post->execute([$delete_id]);
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
    </style>
</head>

<body>
    <?php
    include("manufacturer_header.php");

    // Prepare and execute SQL statement to fetch post information
    $stmt = $conn->prepare("SELECT * FROM manufacturercontact WHERE author_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    ?>
        <h1>All reported issues encountered</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>email</th>
                <th>Issue</th>
                <th>delete</th>

            </tr>
            <?php
            while ($fetch_details = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $fetch_details['id']; ?></td>
                    <td><?= $fetch_details['name']; ?></td>
                    <td><?= $fetch_details['email']; ?></td>
                    <td><?= $fetch_details['message']; ?></td>
                    <td><a href="viewMessage.php?delete=<?= $fetch_details['id']; ?>" onclick="return confirm('Are you certain!')">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "<p class='error'>No reported issues encountered</p>";
        exit();
    }
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $total_records = $stmt->get_result()->fetch_assoc()['total'];
    $total_pages = ceil($total_records / $records_per_page);

    // Display pagination links
    if ($total_pages > 1) {
        echo "<div>";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='viewMessage.php?page=$i'>$i</a> ";
        }
        echo "</div>";
    }
    ?>
    <?php
    include("../includes/footer.php");
    ?>
</body>

</html>