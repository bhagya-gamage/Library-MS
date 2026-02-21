<?php
include '../config.php';

// 1. Security Check: Ensure only Admin can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// 2. Delete Member Logic
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // SQL to delete the member
    $delete_sql = "DELETE FROM users WHERE id = $id";
    
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Member Deleted Successfully!'); window.location='viewmember.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// 3. Fetch All Members
$sql = "SELECT * FROM users WHERE role = 'member'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members</title>
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script> 
</head>
<body>

<div class="container">
    
    <div class="sidebar">
        <h2>LMS Admin</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="addbook.php">➕ Add Book</a>
        <a href="viewbook.php">📚 View Books</a>
        <a href="addmember.php">👤 Add Member</a>
        <a href="viewmember.php" class="active">👥 View Members</a>
        <a href="issuebook.php">📝 Issue Book</a>
        <a href="bookhistory.php">📜 History</a>
        <a href="../logout.php" style="color:#e74c3c;">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h1>Registered Members</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo ucfirst($row['role']); ?></td>
                        <td>
                            <a href="editmember.php?id=<?php echo $row['id']; ?>" 
                               style="color: #3498db; text-decoration: none; font-weight: bold; margin-right: 15px;">
                               Edit
                            </a>
                            
                            <a href="viewmember.php?delete=<?php echo $row['id']; ?>" 
                               onclick="return confirmDelete()" 
                               style="color:red; text-decoration: none; font-weight: bold;">
                               🗑 Delete
                            </a>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>No members found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>