<?php
$host = "localhost";
$user = "root";
$pass = ""; // change if you use a password
$dbname = "bee";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>
