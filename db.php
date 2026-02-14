<?php
$host = "localhost:3307"; // Localhost ki wjha s main error aaya tha 😂😂
$user = "root";
$pass = ""; 
$db   = "dashboard_db";

// Connection line
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>