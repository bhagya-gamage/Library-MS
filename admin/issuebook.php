<?php
include '../config.php';

// Issue book logic (insert into issued_books, update books)

?>

<!DOCTYPE html>
<html>
<head>
    <title>Issue Book</title>
    <link rel="stylesheet" href="../style.css">
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
        <a href="issuebook.php" class="active">📝 Issue Book</a>
        <a href="bookhistory.php">📜 History</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h2>Issue Book</h2>

        <!-- Populate books from DB -->

    </div>
</div>
</body>
</html>

