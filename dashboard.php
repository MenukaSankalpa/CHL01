<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <!-- Sidebar -->
    <?php include('includes/sidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <?php include('includes/header.php'); ?>

        <!-- Dashboard content -->
        <div class="dashboard-container">
            <h1>Welcome Admin!</h1>
            <p>Use the sidebar to navigate through the dashboard options.</p>
        </div>

        <!-- Footer -->
        <?php include('includes/footer.php'); ?>
    </div>

</body>
</html>
