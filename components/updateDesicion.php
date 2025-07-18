<?php
require_once '../includes/db.php';

if (!isset($_POST['selection']) || !is_array($_POST['selection'])) {
    http_response_code(400);
    echo "Invalid data";
    exit;
}

foreach ($_POST['selection'] as $id => $value) {
    $id = intval($id);
    $selection = $conn->real_escape_string($value);
    $conn->query("UPDATE applicants SET selection='$selection' WHERE id=$id");
}

$conn->close();
echo "Success";
?>
