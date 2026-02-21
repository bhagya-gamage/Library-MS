<?php
include '../config.php';

// 1. Security Check: Only admins allowed
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// 2. Fetch Member Data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'member'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();

    if (!$member) {
        die("Member not found.");
    }
}

// 3. Update Logic
if (isset($_POST['update_member'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Update query (Prepared Statement)
    $update_stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $update_stmt->bind_param("ssi", $name, $email, $id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Member details updated!'); window.location='viewmember.php';</script>";
    } else {
        $error = "Update failed. Email might already be in use.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Member</title>
    <link rel="stylesheet" href="../style.css">
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
        <h2>Edit Member Details</h2>
        
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $member['id']; ?>">

            <label>Full Name</label>
            <input type="text" name="name" value="<?php echo $member['name']; ?>" required>

            <label>Email Address</label>
            <input type="email" name="email" value="<?php echo $member['email']; ?>" required>

            <button type="submit" name="update_member">Save Changes</button>
            <a href="viewmember.php" style="display:block; text-align:center; margin-top:10px; color:#666; text-decoration:none;">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>