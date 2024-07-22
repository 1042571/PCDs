<?php
include '../includes/server.php';
//include 'count.php';
//require '../includes/count.php';

// Comment out $user_name below when going live 
$user_name = "manufacturer";
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
            margin: 0;
            padding: 0;
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
<?php
    include("manufacturer_header.php");
    ?>

    <section>
        <h1><?php echo $user_name; ?> Dashboard</h1>

        <div class="grid-container">
            <div class="grid-item">
                <a href="AllProducts.php">
                    <h2>My Products</h2>
                </a>
            </div>

            <div class="grid-item">
                <a href="viewPost.php">
                    <h2>My Blog</h2>
                </a>
            </div>

            <div class="grid-item">
                <a href="viewMessage.php">
                    <h2>My reported issues</h2>
                </a>
            </div>
        </div>
    </section>

    <?php
    include("../includes/footer.php");
    ?>
</body>
</html>
