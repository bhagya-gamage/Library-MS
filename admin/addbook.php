<?php
include '../config.php';

// TODO: Add book logic 
if (isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $cat = $_POST['category'];
    $qty = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO books (title, author, category, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $title, $author, $cat, $qty);
    
    if ($stmt->execute()) echo "<script>alert('Book Added!'); window.location='viewbook.php';</script>";
    else echo "Error: " . $conn->error;
} 

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="addbook.css">
    <link rel="stylesheet" href="sidebar.css">
    <!-- <link rel="stylesheet" href="dashboard.css"> -->
    <title>Add Book</title>
</head>
<body>
<div class="container">

    <div class="sidebar">
        <h2>BookFlow LMS Admin</h2>
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
        <h2>Add New Book</h2>

        <!--  Form + insert logic -->
        <form method="POST">
            <input type="text" name="title" placeholder="Book Title" required>
            <input type="text" name="author" placeholder="Author" required>
            <input type="text" name="category" placeholder="Category" required>
            <input type="number" name="quantity" placeholder="Quantity" required>
            <button type="submit" name="add_book">Add Book</button>
        </form>

    </div>
</div>
</body>
</html>

