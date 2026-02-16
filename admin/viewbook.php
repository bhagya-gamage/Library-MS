<?php
include '../config.php';

// Admin access check

// Delete book logic

// Fetch books list
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Books - Admin</title>
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <h2>LMS Admin</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="addbook.php">➕ Add Book</a>
        <a href="viewbook.php" class="active">📚 View Books</a>
        <a href="addmember.php">👤 Add Member</a>
        <a href="viewmember.php">👥 View Members</a>
        <a href="issuebook.php">📝 Issue Book</a>
        <a href="bookhistory.php">📜 History</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h2>Book List</h2>

        <!-- Load books from database -->

    </div>
</div>
</body>
</html>

