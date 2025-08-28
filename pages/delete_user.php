<?php
include $_SERVER['DOCUMENT_ROOT'].'/CHL01/includes/db.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
    $stmt->execute([$_GET['id']]);
}

header('Location: users.php');
exit;
