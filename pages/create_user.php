<?php
include $_SERVER['DOCUMENT_ROOT'].'/CHL01/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $company = trim($_POST['company_name']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die('Passwords do not match.');
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, company_name, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $company, $hashedPassword]);

    header('Location: users.php');
    exit;
}
