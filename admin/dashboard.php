<?php
include '../config.php';
// Security Check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php"); exit;
}

// Get Stats
$books = $conn->query("SELECT COUNT(*) as c FROM books")->fetch_assoc()['c'];
$members = $conn->query("SELECT COUNT(*) as c FROM users WHERE role='member'")->fetch_assoc()['c'];
$issued = $conn->query("SELECT COUNT(*) as c FROM issued_books WHERE status='Issued'")->fetch_assoc()['c'];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script>
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>BookFlow LMS Admin</h2>
            <a href="dashboard.php">🏠 Dashboard</a>
            <a href="addbook.php">➕ Add Book</a>
            <a href="viewbook.php">📚 View Books</a>
            <a href="addmember.php">👤 Add Member</a>
            <a href="viewmember.php">👥 View Members</a>
            <a href="issuebook.php">📝 Issue Book</a>
            <a href="bookhistory.php">📜 History</a>
            <a href="../logout.php" style="color:#e74c3c;">🚪 Logout</a>
        </div>
        
        <div class="main-content">
            <h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
            <div style="display:flex; gap:20px;">
                <div style="background:white; padding:20px; flex:1; border-left: 5px solid #3498db;">
                    <h3>Total Books</h3> <h1><?php echo $books; ?></h1>
                </div>
                <div style="background:white; padding:20px; flex:1; border-left: 5px solid #2ecc71;">
                    <h3>Members</h3> <h1><?php echo $members; ?></h1>
                </div>
                <div style="background:white; padding:20px; flex:1; border-left: 5px solid #e67e22;">
                    <h3>Issued Books</h3> <h1><?php echo $issued; ?></h1>
                </div>
            </div>
        </div>
    </div>
</body>
</html>