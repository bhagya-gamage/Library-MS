<?php
include '../config.php';

// 1. Security Check: Only admins allowed
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// 2. Delete Logic
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Using a simple query as requested, though prepared statements are safer
    $conn->query("DELETE FROM books WHERE id=$id");
    header("Location: viewbook.php");
    exit;
}

// 3. Fetch Books
$result = $conn->query("SELECT * FROM books");
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
        <a href="../logout.php" style="color:#e74c3c;">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h2>Book List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>
                        <a href="editbook.php?id=<?php echo $row['id']; ?>" 
                           style="color: #3498db; text-decoration: none; font-weight: bold; margin-right: 15px;">
                           Edit
                        </a>
                        
                        <a href="viewbook.php?delete=<?php echo $row['id']; ?>" 
                           onclick="return confirmDelete()" 
                           style="color:red; text-decoration: none; font-weight: bold;">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>