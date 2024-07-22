<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        section {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php include("includes/header.php") ?>

    <header>
        <h1>Forgot Password</h1>
    </header>

    <section>
        <h2>forgotpassword page</h2>
        <form action="forgotpass_script.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" name="reset" value="Reset Password">
        </form>
        <div class="back-link"><a href="login.php">&lt;- Back to Login</a></div>
    </section>

    <?php include("includes/footer.php") ?>
</body>

</html>
