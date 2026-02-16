<?php
include '../config.php';
if ($_SESSION['role'] != 'member') header("Location: ../index.php");

// Borrow Logic (Self Service)
if (isset($_GET['borrow'])) {
    $book_id = $_GET['borrow'];
    $user_id = $_SESSION['user_id'];

    // Check Qty
    $qty = $conn->query("SELECT quantity FROM books WHERE id=$book_id")->fetch_assoc()['quantity'];
    
    if($qty > 0) {
        $conn->query("INSERT INTO issued_books (book_id, user_id) VALUES ($book_id, $user_id)");
        $conn->query("UPDATE books SET quantity = quantity - 1 WHERE id=$book_id");
        echo "<script>alert('Book Borrowed Successfully!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Book not available!');</script>";
    }
}

$books = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="../style.css"></head>
<body>
<div class="container">
    <div class="sidebar">
        <h2>User Panel</h2>
        <a href="dashboard.php">📚 Available Books</a>
        <a href="myhistory.php">📜 My History</a>
        <a href="../logout.php" style="color:#e74c3c">🚪 Logout</a>
    </div>
    <div class="main-content">
        <h1>Available Books</h1>
        <table>
            <tr><th>Title</th><th>Author</th><th>Category</th><th>Available</th><th>Action</th></tr>
            <?php while($row = $books->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['author']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>
                    <?php if($row['quantity'] > 0): ?>
                        <a href="dashboard.php?borrow=<?php echo $row['id']; ?>" style="color:green;">Borrow</a>
                    <?php else: ?>
                        <span style="color:red">Out of Stock</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</body>
</html>