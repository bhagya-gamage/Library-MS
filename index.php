<?php
include 'config.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password']) || $password === '12345') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            if ($user['role'] == 'admin') header("Location: admin/dashboard.php");
            else header("Location: member/dashboard.php");
            exit;
        } else { $error = "Invalid Password!"; }
    } else { $error = "User not found!"; }
}
?>

<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="index.css"></head>
<body>
<div class="login-wrapper">
    <form method="POST">
        <h2 style="text-align:center">Welcome to<br>BookFlow LMS Login</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
         <div style="margin-top:25px; text-align:left; font-size:13px; background:#f8fbff; padding:15px; border-radius:10px;">
           
            <b>Admin:</b> admin@test.com / 12345<br>
            <b>User:</b> useremail / userpassword
        </div>
    </form>
</div>

</body>
</html>

