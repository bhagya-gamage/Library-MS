<?php
include '../config.php';

// Only admin access 
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// Add member logic 
?>



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css">
    <title>Add Book</title>
</head>
<body>
<div class="container">

    <div class="sidebar">
        <h2>LMS Admin</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="addbook.php" class="active">➕ Add Book</a>
        <a href="viewbook.php">📚 View Books</a>
        <a href="addmember.php">👤 Add Member</a>
        <a href="viewmember.php">👥 View Members</a>
        <a href="issuebook.php">📝 Issue Book</a>
        <a href="bookhistory.php">📜 History</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h2>Add New Member</h2>

        <!--  Form + insert logic -->

    </div>
</div>
</body>
</html>

