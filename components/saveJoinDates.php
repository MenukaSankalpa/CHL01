<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['joinDate'])) {
    foreach ($_POST['joinDate'] as $id => $date) {
        if (!empty($date)) {
            $stmt = $conn->prepare("UPDATE applicants SET joinDate = ? WHERE id = ?");
            $stmt->bind_param("si", $date, $id);
            $stmt->execute();
        }
    }
    header("Location: deleteApplicant.php?msg=saved");
    exit;
} else {
    echo "No join dates submitted.";
}
?>
