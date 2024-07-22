<?php
    include '../includes/count.php';
    
    // Pagination configuration
    $records_per_page = 10; // Number of records to display per page
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Current page number

    // Calculate the offset for the SQL query
    $offset = ($page - 1) * $records_per_page;

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        $delete_post = $conn->prepare("DELETE FROM `posts` WHERE id = ?");
        $delete_post->bindParam("i", $delete_id);
        $delete_post->execute();
        $fetch_post_img = $delete_post->fetch(PDO::FETCH_ASSOC);
        unlink("../resource/blogUploads/" . $fetch_post_img['image']);
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
    include("admin_header.php");

    // Prepare and execute SQL statement to fetch post information
    $stmt = $conn->prepare("SELECT * FROM posts");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    ?>
        <h1>All blog posts</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Blog title</th>
                <th>Content</th>
                <th>Author name</th>
                <th>Date published</th>
                <th>Image</th>
                <th>Action</th>

            </tr>
            <?php
            while ($fetch_details = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $fetch_details['id']; ?></td>
                    <td>
                        <a href="singleBlog.php?id=<?= $fetch_details['id']; ?>">
                            <?= $fetch_details['title']; ?>
                        </a>
                    </td>
                    <td><?= $fetch_details['content']; ?></td>
                    <td><?= $fetch_details['author_name']; ?></td>
                    <td><?= $fetch_details['created_at']; ?></td>
                    <td><?= $fetch_details['image'];?></td>
                    <td><a href="viewPost.php?delete=<?= $fetch_details['id']; ?>" onclick="return confirm('Are you sure!')">Delete</a></td>
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
    // Calculate total number of pages file from count.php
    $total_pages = ceil($totalPosts / $records_per_page);

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
