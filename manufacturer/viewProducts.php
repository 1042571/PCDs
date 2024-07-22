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
            margin-bottom: 10px;
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
        }
    </style>
</head>

<body>
<?php
    include("manufacturer_header.php");
    // Prepare and execute SQL statement to fetch drug information
    $stmt = $conn->prepare("SELECT * FROM drugs WHERE id = ?");
    $stmt->execute([$user_id]);
    $drug = $stmt->fetch();

    if ($drug) {
    ?>
        <h1>Drug Information</h1>

        <img src="<?= $drug['image']; ?>" alt="Drug Image">

        <table>
            <tr>
                <th>Attribute</th>
                <th>Value</th>
            </tr>
            <tr>
                <th>Drug Name</th>
                <th><?= $drug['name']; ?></th>
            </tr>
            <tr>
                <td>Active Agent</td>
                <td><?= $drug['activeAgent']; ?></td>
            </tr>
            <tr>
                <td>Drug Batch Number</td>
                <td><?= $drug['drugBatch']; ?></td>
            </tr>
            <tr>
                <td>How drug is administer </td>
                <td><?= $drug['drugDelivery']; ?></td>
            </tr>
            <tr>
                <td>Name of manufacturer</td>
                <td><?= $drug['manufacturerName']; ?></td>
            </tr>
            <tr>
                <td>Manufactured date</td>
                <td><?= $drug['manufacturingDate']; ?></td>
            </tr>
            <tr>
                <td>Expiry date</td>
                <td><?= $drug['expiryDate']; ?></td>
            </tr>
        </table>
    <?php
    } else {
        echo "<p class='error'>Add Products to the database</p>";
        exit();
        
    }

    include("../includes/footer.php");
    ?>


</body>

</html>