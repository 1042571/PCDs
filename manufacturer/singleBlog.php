<?php
require_once "../includes/server.php";
$posts = [];
$comments = [];


if (isset($_GET['id'])) {
    $postid = $_GET['id'];
    // Select post data from the database
    $sql = "SELECT * FROM posts WHERE id=$postid";
    $query = mysqli_query($conn, $sql);
    $posts = mysqli_fetch_all($query, MYSQLI_ASSOC);

    // Select comments associated with the post from the database
    $sql2 = "SELECT * FROM comments WHERE post_id=$postid ORDER BY date DESC LIMIT 5";
    $query2 = mysqli_query($conn, $sql2);
    $comments = mysqli_fetch_all($query2, MYSQLI_ASSOC);
} else {
    // Redirect to the blog page if post ID is not provided
    header("location: blog.php");
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
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .post {
            padding: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .post h2 {
            color: #333;
            margin-top: 0;
        }

        .post p {
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .post .author {
            font-style: italic;
            color: #666;
        }

        .comments {
            margin-top: 30px;
        }

        .comment {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .comment p {
            margin-bottom: 5px;
        }

        .comment .author {
            font-style: italic;
            color: #666;
        }

        .comment-form {
            margin-top: 30px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        form input[type="text"],
        form textarea {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form button {
            background-color: #56c55f;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <?php include("manufacturer_header.php"); ?>

    <div class="container">
        <div class="post">
            <?php
            if ($posts) {
                foreach ($posts as $post) {
            ?>
                    <h2><?= $post['title']; ?></h2>
                    <img src="../resource/blogUploads/<?= $post['image']; ?>" alt="Blog Image" style="max-width: 100%; border-radius: 8px;">
                    <p><?= $post['content']; ?></p>
                    <p class="author">Written by: <?= $post['author_name']; ?></p>
                    <p class="author">Role: <?= $post['role']; ?></p>
        </div>
<?php
                }
            }
?>
<div class="comments">
    <h3>Comments</h3>
    <div class="comment">
        <?php
        if ($comments) {
            foreach ($comments as $comm) {
        ?>
                <p><?= $comm['comment']; ?></p>
                <p class="author"><?= $comm['author_name']; ?></p>
    </div>
<?php
            }
        } else {
            echo '<div  class="error">No comments posted yet.</div>';
        }
?>
</div>

    </div>

    <?php include("../includes/footer.php"); ?>

</body>

</html>