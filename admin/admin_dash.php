<?php
include '../includes/server.php';
include '../includes/count.php';
//comment $user_name bellow when going live 
$user_name = "admin";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        /* Style for grid container */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            justify-items: center;
        }

        /* Style for grid items */
        .grid-item {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        /* Style for images */
        .grid-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        /* Hover effect on grid items */
        .grid-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Heading styles */
        h2 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #007bff;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }
    </style>
</head>

<body>
    <?php include("admin_header.php") ?>

    <section>
        <h1>| <?php echo $user_name; ?> | Dashboard</h1>

        <div class="grid-container">
            <div class="grid-item"> 
                <a href="viewUsers.php">
                    <h2>Total Users</h2>
                </a>
                <p><?php echo $totalUsers; ?></p>
            </div>

            <div class="grid-item">
                <a href="viewManufacturer.php">
                    <h2>Total Manufacturers</h2>
                </a>
                <p><?php echo $totalManufacturer ?></p>
            </div>

            <div class="grid-item">
                <a href="viewAdmin.php">
                    <h2>Admin</h2>
                </a>
                <p><?php echo $totalAdmin; ?></p>
            </div>

            <div class="grid-item">
                <a href="viewReports.php">
                    <h2>User Reports</h2>
                </a>
                <p><?php echo $totalReports; ?></p>
            </div>

            <div class="grid-item">
                <a href="viewPost.php">
                    <h2>Blog Posts</h2>
                </a>
                <p><?php echo $totalPosts; ?></p>
            </div>

            <div class="grid-item">
                <a href="viewMyPost.php">
                    <h2>My Posts</h2>
                </a>
            </div>
        </div>
    </section>

    <?php include("../includes/footer.php"); ?>
</body>

</html>
