<?php
include '../config.php';

// Only admin access 
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// Add member logic
if(isset($_POST['add_member'])) {
    $name=$_POST['name'];
    $email= $_POST['email'];

    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $role = 'member' ;

    $stmt =$conn-> prepare("INSERT INTO users(name,email,password,role)VALUES(?,?,?,?)");
    $stmt->bind_param("ssss",$name, $password ,$role);

    if($stmt->execute()){
        echo"<script>alert('Member Registered Successfully!);window.location ='viewmember.php';</script>";
    }else{
        $error= "Error: Emailmight already exist.";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css">
    <title>Add Book</title>
</head>
<body>
<div class="container">

    <div class="sidebar">
        <h2>LMS Admin</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="addbook.php" class="active">➕ Add Book</a>
        <a href="viewbook.php">📚 View Books</a>
        <a href="addmember.php">👤 Add Member</a>
        <a href="viewmember.php">👥 View Members</a>
        <a href="issuebook.php">📝 Issue Book</a>
        <a href="bookhistory.php">📜 History</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h2>Add New Member</h2>
        <?php if(isset($error)) echo "<p class = 'error'>$error</p>";?>

        <!--  Form + insert logic -->
        <form method="POST">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Enter Full Name" required>

            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter Email" required>

            <label>Temporary Password</label>
            <input type="password" name="password" placeholder="Create Password" required>

            <button types="submit"name="add_member">Register Member</button>
        </form>


    </div>
</div>
</body>
</html>

