<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drug Safety Blog</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        article {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            color: #004080;
        }

        p {
            line-height: 1.6;
        }

        a {
            color: #007bff;
            text-decoration: underline;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_SESSION['manufacturer_id']) && ($_SESSION['manufacturer_name'])) {
        include("../manufacturer/manufacturer_header.php");
        echo "1";
    } elseif (isset($_SESSION['user_id'])) {
        include("../user/user_header.php");
        echo "2";
    }else{
        include("../admin/admin_header.php");
        //include("../manufacturer/manufacturer_header.php");
    }
    ?>

    <header>
        <h1>Drug Safety Blog</h1>
    </header>

    <article>
        <h2>Understanding Drug Counterfeiting</h2>
        <p>
            Drug counterfeiting is a serious issue that poses significant risks to public health. Counterfeit drugs may contain incorrect ingredients, incorrect dosage, or even harmful substances. It's crucial to be aware of the dangers associated with counterfeit medications.
        </p>

        <h2>Common Signs of Counterfeit Drugs</h2>
        <p>
            <strong>1. Packaging:</strong> Check for signs of poor quality, misspelled words, or broken seals on the drug packaging.
        </p>
        <p>
            <strong>2. Source:</strong> Purchase medications only from reputable and licensed pharmacies to minimize the risk of counterfeit drugs.
        </p>
        <p>
            <strong>3. Physical Characteristics:</strong> Examine the appearance, color, and shape of the medication. Any inconsistencies may indicate a counterfeit product.
        </p>

        <h2>How to Stay Safe</h2>
        <p>
            To stay safe from counterfeit drugs, always verify the source, check the packaging, and consult with healthcare professionals if you have any concerns. Additionally, report any suspicious activities to regulatory authorities.
        </p>

        <p>
            Stay informed and prioritize your health when it comes to medication safety.
        </p>
    </article>
    <?php
    include("includes/footer.php");
    ?>
</body>

</html>