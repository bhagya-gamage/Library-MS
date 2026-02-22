<?php
include '../config.php';

// 1. Security Check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['issue'])) {
    $book_id = $_POST['book_id'];
    $user_id = $_POST['user_id'];
    // Capture the current date
    $issue_date = date('Y-m-d'); 

    // Check availability
    $check = $conn->query("SELECT quantity FROM books WHERE id=$book_id");
    $book = $check->fetch_assoc();

    if ($book['quantity'] > 0) {
        // Issue Book with current date
        $stmt = $conn->prepare("INSERT INTO issued_books (book_id, user_id, issue_date, status) VALUES (?, ?, ?, 'Issued')");
        $stmt->bind_param("iis", $book_id, $user_id, $issue_date);
        
        if ($stmt->execute()) {
            // Decrease Qty
            $conn->query("UPDATE books SET quantity = quantity - 1 WHERE id=$book_id");
            echo "<script>alert('Book Issued Successfully on $issue_date'); window.location='bookhistory.php';</script>";
        }
    } else {
        echo "<script>alert('Book Out of Stock');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Issue Book</title>
    <link rel="stylesheet" href="issuebook.css">
    <link rel="stylesheet" href="sidebar.css">
</head>
<body>

<div class="container">
<?php require('sidebar.php');?>
    
    <div class="main-content">
        <h1>Issue Book</h1>
        <form method="POST">
            <label>Select Member</label>
            <select name="user_id" required>
                <option value="">Select Member</option>
                <?php 
                $users = $conn->query("SELECT * FROM users WHERE role='member'");
                while($u = $users->fetch_assoc()) echo "<option value='".$u['id']."'>".$u['name']."</option>";
                ?>
            </select>

            <label>Select Book</label>
            <select name="book_id" required>
                <option value="">Select Book</option>
                <?php 
                $books = $conn->query("SELECT * FROM books");
                while($b = $books->fetch_assoc()) echo "<option value='".$b['id']."'>".$b['title']." (Qty: ".$b['quantity'].")</option>";
                ?>
            </select>
            
            <button type="submit" name="issue">Issue Book</button>
        </form>
    </div>
</div>
</body>
</html>