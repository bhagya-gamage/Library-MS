<?php
include '../config.php';

// Member access check

// Fetch issued books for logged in member
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Borrowing History</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="sidebar">
        <h2>User Panel</h2>
        <a href="dashboard.php">📚 Available Books</a>
        <a href="my_history.php" class="active">📜 My History</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h1>My Book History</h1>

        <!-- Load user borrowing history -->

    </div>
</div>

</body>
</html>

