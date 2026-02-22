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
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="sidebar.css">
    <script src="../script.js"></script>
    <title>Admin Dashboard</title>
</head>
<body>
<div class="container">

<!-- ===== Sidebar ===== -->

<?php require('sidebar.php');?>

<!-- ===== Main Content ===== -->
<div class="main-content">

    <!-- Topbar -->
    <div class="topbar">
        <h1>Welcome,BookFlow LMS 👋</h1>

        <div class="profile">
            <!-- <img src="https://i.pravatar.cc/150?img=3">
            <span>Admin</span> -->
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="cards">

        <div class="card books">
            <h3>Total Books</h3>
            <h1><?php echo $books; ?></h1>
        </div>

        <div class="card members">
            <h3>Total Members</h3>
            <h1><?php echo $members; ?></h1>
        </div>

        <div class="card issued">
            <h3>Issued Books</h3>
            <h1><?php echo $issued; ?></h1>
        </div>

    </div>

    <!-- Extra Section -->
    <br><br>

    <div style="background:white;padding:25px;border-radius:12px;box-shadow:0 5px 15px rgba(0,0,0,0.05);">
        <h2>📢 Library Tips</h2>
        <ul>
            <li>✔ Always return books on time.</li>
            <li>✔ Update member details regularly.</li>
            <li>✔ Check overdue books weekly.</li>
            <li>✔ Backup database monthly.</li>
        </ul>
    </div>

</div>

</div>

</body>
</html>