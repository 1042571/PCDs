<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        header {
            background-color: #fbe9dd;
            color: #000000;
            padding: 20px;
            text-align: center;
        }

        section {
            padding: 40px 20px;
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        a.section-link {
            text-decoration: none;
            color: inherit;
            /* Inherit text color from parent */
            display: block;
            /* Make the whole section clickable */
            margin: 20px auto;
            max-width: 800px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Add shadow effect */
            border-radius: 8px;
            transition: box-shadow 0.3s ease-in-out;
            /* Smooth transition for shadow */
        }

        a.section-link:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            /* Increase shadow on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td {
            padding: 10px;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 0 auto;
            transition: transform 0.3s ease-in-out;
        }

        img:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <?php
    include("user_header.php");
    ?>

    <header>
        <h1>Search Medical Authenticity Page</h1>
    </header>

    <section>
        <form action="#" method="post">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Enter Batch Number or lot code here" required>

            <input type="submit" value="Search">
        </form>
    </section>


    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search_item = $_POST["search"];
        $search_item = filter_var($search_item, FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "SELECT * FROM `drugs` WHERE drugBatch LIKE ? ";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("s", $search_item);
        $stmt->execute();
        $products = $stmt->get_result();
        //$products = $stmt->fetch(); // Fetch all matching products


        if ($products) {
            foreach ($products as $product) {
    ?>
                <!--display found data -->
                <a href="drugDisplay.php?id=<?= $product['id']; ?>" class="section-link">
                    <section>
                        <table>
                            <tbody>
                                <tr>
                                    <td><?= $product['name']; ?></td>
                                </tr>
                                <tr>
                                    <td><?= $product['manufacturerName']; ?></td>
                                </tr>
                                <tr>
                                    <td><?= $product['expiryDate']; ?></td>
                                </tr>
                                <tr>
                                    <td><img src="../resource/manufactureUploads/<?= $product['image']; ?>" alt="Product Image" style="max-width: 50px; max-height: 50px;"></td>

                                </tr>
                            </tbody>
                        </table>
                    </section>
                </a>
    <?php
            }
        } else {
            echo '<div  class="error">No drug found with the specified code.</div>';
            echo '<a href="drugVerificationWarning.php"><div style="color: red; text-align: center;">What to do!!</div></a>';

            //header("location: drugVerificationWarning.php");
            exit();
        }
    }
    include("../includes/footer.php");
    ?>

</body>

</html>