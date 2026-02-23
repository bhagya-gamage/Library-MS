<?php
include '../config.php';

// 1. Security Check: Only admins allowed
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

//  Form Submission
if (isset($_POST['add_member'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rawPassword = $_POST['password'];

    // validation 
    if (strlen($rawPassword) <= 5) {
        $error = "Password must be more than 5 characters!";
    } else {

        // Only runs if password is valid
        $password = password_hash($rawPassword, PASSWORD_DEFAULT);
        $role = 'member';

        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $role);

        if ($stmt->execute()) {
            echo "<script>alert('Member Registered Successfully!'); window.location='viewmember.php';</script>";
        } else {
            $error = "Error: Email might already exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="addmember.css">
    <link rel="stylesheet" href="sidebar.css">
    <title>Add Member</title>
</head>
<body>
<div class="container">
    
    <?php require('sidebar.php');?>

    <div class="main-content">
        <h2>Add New Member</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <form method="POST">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Enter Full Name" required>
            
            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter Email" required>
            
            <label>Temporary Password</label>
            <input type="password" name="password" placeholder="Create Password" minlength="6" required>
            
            <button type="submit" name="add_member">Register Member</button>
        </form>
    </div>
</div>
</body>
</html>