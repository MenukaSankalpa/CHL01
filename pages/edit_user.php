<?php
include $_SERVER['DOCUMENT_ROOT'].'/CHL01/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $company = trim($_POST['company_name']);
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, company_name=?, password=? WHERE id=?");
        $stmt->execute([$name, $email, $company, $hashedPassword, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, company_name=? WHERE id=?");
        $stmt->execute([$name, $email, $company, $id]);
    }

    header('Location: users.php');
    exit;
}

// GET request: fetch user data
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
    $stmt->execute([$_GET['id']]);
    $user = $stmt->fetch();
    if (!$user) die("User not found.");
}
