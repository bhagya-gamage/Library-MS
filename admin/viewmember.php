<?php
include '../config.php';

// Admin access check

// Delete member logic

// Fetch members list
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Members</title>
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script>
</head>
<body>

<div class="container">

    <div class="sidebar">
        <h2>LMS Admin</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="addbook.php">➕ Add Book</a>
        <a href="viewbook.php">📚 View Books</a>
        <a href="addmember.php">👤 Add Member</a>
        <a href="viewmember.php" class="active">👥 View Members</a>
        <a href="issuebook.php">📝 Issue Book</a>
        <a href="bookhistory.php">📜 History</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h1>Registered Members</h1>

        <!-- TODO: Load members from database -->

    </div>
</div>

</body>
</html>

