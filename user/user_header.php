<?php
include '../includes/server.php';

session_start();
$user_id = "";
//add comment to not require login
if (isset($_SESSION['user_id']) && ($_SESSION['user_name'])) {
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
} else {
  $user_id = "";
  $user_name = "";
  header("location: ../login.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .header {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      max-height: 100%;
      cursor: pointer;
    }

    .navbar {
      display: flex;
    }

    .navbar a {
      color: #fff;
      text-decoration: none;
      padding: 10px;
      margin-right: 10px;
    }

    .navbar a:hover {
      background-color: #3e8e41;
    }

    .success {
      margin: 10px;
      padding: 10px;
      background-color: green;
      color: #000;
      border: 1px solid #ccc;
    }

    .error {
      margin: 10px;
      padding: 10px;
      background-color: red;
      color: #000;
      border: 1px solid #ccc;
    }
  </style>

  <title>Pharmaceuticals Counterfeit Detection System</title>
</head>

<body>

  <div class="header">
    <a href="user_dash.php">
      <div class="logo">
        <img src="../resource/icon.svg" title="Home">
      </div>
    </a>
    <div class="navbar">
      <a href="search.php">Search Medical Products</a>
      <a href="identifyDrug.php">How to...</a>
      <a href="contact.php">Contact Us</a>
      <a href="about.php">About Us</a>
      <a href="blog.php">Blog</a>
      <a href="user_update.php">Update Self</a>
      <a href="../includes/logout.php" onclick="return confirm('Are you sure you want to log out?');" style="background-color: #ff6f61; color: #fff; padding: 10px 20px; border-radius: 5px;">Log Out</a>
    </div>
  </div>


</body>

<script>
  // Function to hide the message after a specified time (in milliseconds)
  function hideMessage() {
    // Get the message elements
    var messageElements = document.querySelectorAll('.error, .success');

    // Loop through each message element
    messageElements.forEach(function(element) {
      // Set a timeout to hide the message after 5 seconds (5000 milliseconds)
      setTimeout(function() {
        element.style.display = 'none'; // Hide the message
      }, 5000); // Adjust the time as needed (5 seconds in this example)
    });
  }

  // Call the hideMessage function when the page loads
  window.onload = hideMessage;
</script>


</html>