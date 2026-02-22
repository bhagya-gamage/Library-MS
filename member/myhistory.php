<?php
include '../config.php';

// 1. Security Check: Ensure only a logged-in Member can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'member') {
    header("Location: ../index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// 2. Fetch borrowing history for THIS specific user only
// We use a JOIN to get the book titles from the 'books' table
$sql = "SELECT i.issue_date, i.return_date, i.status, b.title, b.author 
        FROM issued_books i 
        JOIN books b ON i.book_id = b.id 
        WHERE i.user_id = ? 
        ORDER BY i.id DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Borrowing History</title>
    <link rel="stylesheet" href="myhistory.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="container">
    <div class="sidebar">
        <h2>User Panel</h2>
        <a href="dashboard.php">📚 Available Books</a>
        <a href="my_history.php" class="active">📜 My History</a>
        <a href="../logout.php" style="color:#e74c3c">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h1>My Book History</h1>
        <p>Welcome, <strong><?php echo $_SESSION['name']; ?></strong>. Here is your activity log:</p>

        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['author']; ?></td>
                            <td><?php echo $row['issue_date']; ?></td>
                            <td>
                                <?php 
                                    // If return_date is null, show a dash
                                    echo $row['return_date'] ? $row['return_date'] : "--"; 
                                ?>
                            </td>
                            <td>
                                <span style="font-weight:bold; color: <?php echo ($row['status'] == 'Issued') ? '#e67e22' : '#2ecc71'; ?>">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">You haven't borrowed any books yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>