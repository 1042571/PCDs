<?php
require_once "../includes/server.php";

// Pagination configuration
$results_per_page = 5; // Number of results per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $results_per_page; // Offset for SQL query

// Fetch posts for the current page
$sql = "SELECT * FROM posts LIMIT $offset, $results_per_page";
$query = mysqli_query($conn, $sql);
$posts = mysqli_fetch_all($query, MYSQLI_ASSOC);

// Count total number of posts
$total_posts_sql = "SELECT COUNT(*) AS total FROM posts";
$total_posts_query = mysqli_query($conn, $total_posts_sql);
$total_posts_row = mysqli_fetch_assoc($total_posts_query);
$total_posts = $total_posts_row['total'];

// Calculate total number of pages
$total_pages = ceil($total_posts / $results_per_page);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            margin-top: 20px;
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: auto;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-content {
            padding: 20px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 0;
        }

        .card-text {
            margin-bottom: 15px;
        }

        .author {
            font-style: italic;
            color: #666;
        }

        .created-at {
            color: #666;
        }
    </style>
</head>

<body>
    <?php include("admin_header.php"); ?>
    <div class="container">
        <div class="card">
            <?php
            if ($posts) {
                foreach ($posts as $post) {
            ?>
                    <img src="../resource/blogUploads/<?= $post['image']; ?>" alt="Card Image" style="max-width: 100%; border-radius: 8px;">
                    <div class="card-content">
                        <a href="singleBlog.php?id=<?= $post['id']; ?>">
                            <h2 class="card-title"><?= $post['title']; ?></h2>
                        </a>
                        <p class="card-text"><?= substr($post['content'], 0, 200); ?></p>
                        <p class="author">Author: <?= $post['author_name']; ?></p>
                        <p class="created-at">Posted at: <?= $post['created_at']; ?></p>
                    </div>
            <?php
                }
            } else {
                echo '<div  class="error">No posts yet.</div>';
            }
            ?>
        </div>
        <!-- Pagination links -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <a href="?page=<?= $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?= $i; ?></a>
            <?php endfor; ?>
        </div>
    </div>
    <?php include("../includes/footer.php"); ?>
</body>

</html>