<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Product Landing Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1, h2 {
            color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        section {
            padding: 40px 20px;
            text-align: center;
        }

        .hero {
            background-color: #555;
            color: #fff;
            padding: 60px;
            text-align: center;
        }

        .features {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border-radius: 8px;
        }

        .feature {
            margin-bottom: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <header>
        <h1>welcome <strong><?php echo $_SESSION['user_name']; ?></strong></h1>
        <p>Revolutionizing the way you do things</p>
    </header>

    <section class="hero">
        <h2>Welcome to Your Product</h2>
        <p>Experience the power of innovation</p>
        <a href="#features">Learn More</a>
    </section>

    <section id="features" class="features">
        <h2>Key Features</h2>
        <div class="feature">
            <h3>Feature 1</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="feature">
            <h3>Feature 2</h3>
            <p>Nullam euismod urna at mi varius, sit amet aliquam risus mattis.</p>
        </div>
        <div class="feature">
            <h3>Feature 3</h3>
            <p>Vestibulum ac nisi eget massa fermentum efficitur.</p>
        </div>
    </section>
<!--
    <footer>
        &copy; 2023 Your Product. All rights reserved.
    </footer>
-->
</body>
</html>
