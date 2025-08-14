<?php
session_start();

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $adminUser = 'admin';
    $adminPass = 'admin@123';

    if ($username === $adminUser && $password === $adminPass) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Username or password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin Login</title>
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="login-wrapper">
    <!-- Left: Login Form -->
    <div class="login-container glass-effect">
        <form method="POST" class="login-form">
            <h2>ADMIN LOGIN</h2>
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required />
                <i class="fas fa-user"></i>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" id="password" required />
                <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
            </div>
            <button type="submit" name="login">Login</button>

            <?php if (!empty($error)) { echo "<div class='error hidden'>$error</div>"; } ?>
        </form>
    </div>

    <!-- Right: Video Background -->
    <div class="video-container">
        <video autoplay loop muted playsinline>
            <source src="video/login-animation.mp4" type="video/mp4">
        </video>
    </div>
</div>

<script>
function togglePassword() {
    const passwordField = document.getElementById("password");
    const toggleIcon = document.querySelector(".toggle-password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        passwordField.type = "password";
        toggleIcon.classList.replace("fa-eye-slash", "fa-eye");
    }
}

document.querySelectorAll(".input-group input").forEach(input => {
    input.addEventListener("focus", () => {
        const errorBox = document.querySelector(".error");
        if (errorBox) {
            errorBox.classList.remove("hidden");
        }
    });
});
</script>
</body>
</html>
