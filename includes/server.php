<?php

// initializing variables
$server = 'localhost';
$username = '1042571';
$password = 'B9cbn-OO2yJg]VPM';
$database = 'pcd';


// connect to the database
$conn = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$conn) {
  die("ERROR: Could not connect." . mysqli_connect_error());
}
