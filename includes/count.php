<?php
include 'server.php';
//uncomment when going live
$user_id=1;
// Query to count users
$sql = "SELECT COUNT(*) as total_users FROM users";
$result = $conn->query($sql);

$sql1 = "SELECT COUNT(*) as total_reports FROM drugreport";
$result1 = $conn->query($sql1);

$sql2 = "SELECT COUNT(*) as total_manufacturers FROM drugmanufacturer";
$result2 = $conn->query($sql2);

$sql3 = "SELECT COUNT(*) as total_admin FROM admin";
$result3 = $conn->query($sql3);

//list all posts
$sql4 = "SELECT COUNT(*) as total_post FROM posts";
$result4 = $conn->query($sql4);

/*  uncomment to show total role post by id
//admin post by id
$sql5 = "SELECT COUNT(*) as admin_total_post_by_id FROM posts WHERE author_id = $user_id AND role = 'admin'";
$result5 = $conn->query($sql5);

//manufacturer post by id
$sql6 = "SELECT COUNT(*) as manufacturer_total_post_by_id FROM posts WHERE author_id = $user_id AND role = 'manufacturer'";
$result6 = $conn->query($sql6);*/

$sql7 = "SELECT COUNT(*) as manufacturer_report_by_id FROM manufacturercontact where author_id = $user_id";
$result7 = $conn->query($sql7);

$sql8 = "SELECT COUNT(*) as manufacturer_products_by_id FROM drugs where manufacturer_id = $user_id";
$result8 = $conn->query($sql8);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalUsers = $row['total_users'];
} else {
    $totalUsers = 0;
}

if ($result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
    $totalReports = $row['total_reports'];
} else {
    $totalReports = 0;
}

if ($result2->num_rows > 0) {
    $row = $result2->fetch_assoc();
    $totalManufacturer = $row['total_manufacturers'];
} else {
    $totalManufacturer = 0;
}
if ($result3->num_rows > 0) {
    $row = $result3->fetch_assoc();
    $totalAdmin = $row['total_admin'];
} else {
    $totalAdmin = 0;
}
if ($result4->num_rows > 0) {
    $row = $result4->fetch_assoc();
    $totalPosts = $row['total_post'];
} else {
    $totalPosts = 0;
}
/*
//admin total posts
if ($result5->num_rows > 0) {
    $row = $result5->fetch_assoc();
    $admin_total_post_by_id = $row['admin_total_post_by_id'];
} else {
    $totalPosts = 0;
}
//manufacturer total posts
if ($result5->num_rows > 0) {
    $row = $result5->fetch_assoc();
    $manufacturer_total_post_by_id = $row['manufacturer_total_post_by_id'];
} else {
    $totalPosts = 0;
}
*/
if ($result7->num_rows > 0) {
    $row = $result7->fetch_assoc();
    $manufacturer_report_by_id = $row['manufacturer_report_by_id'];
} else {
    $manufacturer_report_by_id = 0;
}

if ($result8->num_rows > 0) {
    $row = $result8->fetch_assoc();
    $manufacturer_products_by_id = $row['manufacturer_products_by_id'];
} else {
    $manufacturer_products_by_id = 0;
}

$conn->close();
