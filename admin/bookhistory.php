<?php
include '../config.php';

// Return Book Logic
if (isset($_GET['return'])) {
    $issue_id = $_GET['return'];
    $book_id = $_GET['book_id'];

    $conn->query("UPDATE issued_books SET status='Returned', return_date=CURRENT_DATE WHERE id=$issue_id");
    $conn->query("UPDATE books SET quantity = quantity + 1 WHERE id=$book_id");
    header("Location: bookhistory.php");
}

$sql = "SELECT i.id, i.book_id, b.title, u.name, i.issue_date, i.return_date, i.status 
        FROM issued_books i 
        JOIN books b ON i.book_id = b.id 
        JOIN users u ON i.user_id = u.id 
        ORDER BY i.id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="bookhistory.css">
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="sidebar.css">
</head>
<body>
<div class="container">
    <div class="sidebar">
        <h2>BookFlow LMS Admin</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="addbook.php">➕ Add Book</a>
        <a href="viewbook.php">📚 View Books</a>
        <a href="addmember.php" class="active">👤 Add Member</a>
        <a href="viewmember.php">👥 View Members</a>
        <a href="issuebook.php">📝 Issue Book</a>
        <a href="bookhistory.php">📜 History</a>
        <a href="../logout.php" style="color:#e74c3c;">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h1>Issue/Return History</h1>
        <table>
            <tr><th>Book</th><th>Member</th><th>Issue Date</th><th>Return Date</th><th>Status</th><th>Action</th></tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td><?php echo $row['return_date'] ? $row['return_date'] : '-'; ?></td>
                <td>
                    <span style="color: <?php echo $row['status']=='Issued' ? 'red' : 'green'; ?>">
                        <?php echo $row['status']; ?>
                    </span>
                </td>
                <td>
                    <?php if($row['status'] == 'Issued'): ?>
                        <a href="bookhistory.php?return=<?php echo $row['id']; ?>&book_id=<?php echo $row['book_id']; ?>">Return</a>
                    <?php else: ?>
                        Completed
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</body>
</html>