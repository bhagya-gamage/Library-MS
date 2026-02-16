<?php
$host = "localhost";
$user = "root";
$pass = "12345";
$db = "library_ms_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>