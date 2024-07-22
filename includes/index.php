<?php 
  //include auth.php
?>
<!DOCTYPE html>
<html>
<head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
        <h2>Home Page</h2>
</div>
<div class="content">
        <p>Welcome <strong><?php echo $_SESSION['user_name']; ?></strong></p>
        <p> <a href="logout.php" style="color: red;">logout</a> </p>
</div>
                
</body>
</html>