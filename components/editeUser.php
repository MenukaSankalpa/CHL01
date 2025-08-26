<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

include('../db.php');

if (!isset($_GET['id'])) exit();

$id = intval($_GET['id']);
$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if (!$user) exit("User not found.");

// Handle Update
if (isset($_POST['update_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $company_name = $_POST['company_name'];
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET name='$name', email='$email', company_name='$company_name', password='$password' WHERE id=$id");
    } else {
        $conn->query("UPDATE users SET name='$name', email='$email', company_name='$company_name' WHERE id=$id");
    }
    header("Location: createUser.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit User</title>
<link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<?php include('includes/sidebar.php'); ?>
<div class="main-content">
    <?php include('includes/header.php'); ?>
    <div class="dashboard-container">
        <h2>Edit User</h2>
        <form method="POST">
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <input type="text" name="company_name" value="<?php echo htmlspecialchars($user['company_name']); ?>" required>
            <input type="password" name="password" placeholder="New Password (leave blank to keep old)">
            <button type="submit" name="update_user">Update User</button>
        </form>
    </div>
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>
