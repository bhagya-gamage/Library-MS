<?php
include '../config.php';

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php"); exit;
}

// Get the book details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = $conn->query("SELECT * FROM books WHERE id = $id");
    $book = $res->fetch_assoc();
}

// Update Logic
if (isset($_POST['update_book'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $cat = $_POST['category'];
    $qty = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE books SET title=?, author=?, category=?, quantity=? WHERE id=?");
    $stmt->bind_param("sssii", $title, $author, $cat, $qty, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Book Updated Successfully!'); window.location='viewbook.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="editbook.css">
    <title>Edit Book</title>
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
        <a href="../logout.php" style="color:#e74c3c;">🚪 Logout</a>
    </div>
    <div class="main-content">
        <h2>Update Book Details</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
            
            <label>Book Title</label>
            <input type="text" name="title" value="<?php echo $book['title']; ?>" required>
            
            <label>Author</label>
            <input type="text" name="author" value="<?php echo $book['author']; ?>" required>
            
            <label>Category</label>
            <input type="text" name="category" value="<?php echo $book['category']; ?>" required>
            
            <label>Quantity</label>
            <input type="number" name="quantity" value="<?php echo $book['quantity']; ?>" required>
            
            <button type="submit" name="update_book">Update Book Info</button>
            <a href="viewbook.php" style="display:block; text-align:center; margin-top:10px; color:#666; text-decoration:none;">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>