<?php
include '../config.php';

// Feature: Book History (Issue/Return)

// TODO: Return book logic (update issued_books & books)

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css">
    <title>Book History</title>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <h2>LMS Admin</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="addbook.php">➕ Add Book</a>
        <a href="viewbook.php">📚 View Books</a>
        <a href="addmember.php">👤 Add Member</a>
        <a href="viewmember.php">👥 View Members</a>
        <a href="issuebook.php">📝 Issue Book</a>
        <a href="bookhistory.php" class="active">📜 History</a>
        <a href="../logout.php" style="color:#e74c3c;">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h2>Issue / Return History</h2>

        <!-- Load issue history from database -->

    </div>
</div>
</body>
</html>

