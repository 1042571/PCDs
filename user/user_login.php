<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
        <h2>Login</h2>
  </div>

  <?php
        require('server.php');
        // If form submitted, insert values into the database.
        if (isset($_POST['username'])){
                // removes backslashes
                $username = stripslashes($_REQUEST['username']);
                //escapes special characters in a string
                $username = mysqli_real_escape_string($db,$username);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($db,$password);
                //Checking is user existing in the database or not
                $query = "SELECT * FROM `users` WHERE user_name='$username'
                        and password =' ".md5($password)."'";
                $result = mysqli_query($db,$query) or die(mysqli_error($db));
                $rows = mysqli_num_rows($result);
                if($rows==1){
                $_SESSION['username'] = $username;
                // Redirect user to index.php
                header("Location: index.php");
                exit();
                }else{
                echo "<div class='form'>
                        <h3>Username/password is incorrect.</h3>
                        <br/>Click here to <a href='user_login.php'>Login</a></div>";
                }
        }else{
?>
  <form method="post" action=" ">
        <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="User Name" required>
        </div>
        <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-group">
                <button type="submit" class="btn" name="submit">Login</button>
        </div>
        <p>
                Not yet a member? <a href="user_registration.php">Sign up</a>
        </p>
  </form>
  <?php } ?>
</body>
</html>