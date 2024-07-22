<?php
include '../includes/server.php';
include '../includes/count.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* General styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
    }

    h1 {
      text-align: center;
      margin: 20px 0;
    }

    /* Style for grid container */
    .grid-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-bottom: 40px;
    }

    /* Style for grid items */
    .grid-item {
      flex: 1;
      /* Take up full available width */
      padding: 20px;
      text-align: center;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      margin: 10px;
      /* Add margin for spacing between items */
    }

    /* Style for images */
    .grid-item img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    /* Style for text content */
    h2 {
      font-size: 24px;
      margin-bottom: 10px;
      color: #007bff;
      /* Blue color for headings */
    }

    p {
      font-size: 16px;
      line-height: 1.6;
      color: #666;
    }

    /* Hover effect on grid items */
    .grid-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    /* Statistics section */
    .statistics {
      text-align: center;
    }

    .statistics h3 {
      margin-bottom: 20px;
      color: #007bff;
    }

    .statistics .grid-container {
      justify-content: space-around;
    }

    /* Additional styles for grid items in statistics */
    .statistics .grid-item {
      flex: 0 0 calc(30% - 20px);
      max-width: calc(30% - 20px);
    }
  </style>
</head>

<body>
  <?php
  include("manufacturer_header.php")
  ?>

  <section>
    <h1>About Us</h1>
    <div class="grid-container">
      <!-- Grid item 1 -->
      <div class="grid-item">
        <img src="../resource/mistral-glorious-bird.jpg" alt="Image">
        <h2>Mission</h2>
        <p>Our mission is to safeguard public health and integrity by developing and deploying advanced pharmaceutical counterfeit detection systems.</p>
      </div>

      <!-- Grid item 2 -->
      <div class="grid-item">
        <img src="../resource/vision.jpg" alt="Image">
        <h2>Vision</h2>
        <p>Our vision is to become a global leader in pharmaceutical security through cutting-edge counterfeit detection solutions.</p>
      </div>
    </div>

    <div class="statistics">
      <h3>Our Statistics</h3>
      <div class="grid-container">
        <div class="grid-item">
          <h2>Active Users</h2>
          <p><?php echo $totalUsers; ?></p>
        </div>
        <div class="grid-item">
          <h2>Reported Counterfeit Products</h2>
          <p><?php echo $totalReports ?></p>
        </div>
        <div class="grid-item">
          <h2>Beneficiaries</h2>
          <p><?php echo $totalManufacturer; ?></p>
        </div>
      </div>
    </div>
  </section>
  <?php
  include("../includes/footer.php");
  ?>
</body>

</html>