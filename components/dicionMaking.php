<?php
require_once '../includes/db.php';

$id = $_POST['id'];
$selection = $_POST['selection'];

$stmt = $conn->prepare("UPDATE applicants SET selection_status = ? WHERE id = ?");
$stmt->bind_param("si", $selection, $id);

if ($stmt->execute()) {
    header("Location: view_applicant.php?updated=1");
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
