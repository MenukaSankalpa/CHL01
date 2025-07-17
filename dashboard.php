<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();

    if (isset($_GET['redirect']) && $_GET['redirect'] === 'main') {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="css/dashboard.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
</head>
<body>
  <div class="logout-container">
    <a href="dashboard.php?logout=true&redirect=main" class="btn logout-btn">Logout</a>
  </div>
  <div class="dashboard-container">
    <div class="top-buttons">
      <a href="components/addApplicant.html" class="btn">Add Applicant</a>
      <a href="view_applicant.php" class="btn">View Applicant</a>
      <a href="delete_applicant.php" class="btn">Delete Applicant</a>
    </div>

    <div class="center-message">
      <h1>Hello Dear 🤗</h1>
    </div>
  </div>
</body>
</html>
