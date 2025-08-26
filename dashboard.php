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
    <link rel="stylesheet" href="/CHL01/css/dashboard.css">
    
</head>
<body>

    <!-- Sidebar -->
    <?php include('includes/sidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <?php include('includes/header.php'); ?>

        <!-- Dynamic Content Section -->
        <div class="dashboard-container" id="page-content">
            <?php include('components/welcome.php'); ?>
        </div>

        <!-- Footer -->
        <?php include('includes/footer.php'); ?>
    </div>

<script>
// AJAX page loader
const links = document.querySelectorAll('.ajax-link');
const content = document.getElementById('page-content');

links.forEach(link => {
    link.addEventListener('click', function(e){
        e.preventDefault();
        const url = this.getAttribute('href');

        fetch(url)
            .then(res => res.text())
            .then(html => {
                content.innerHTML = html;
                window.history.pushState(null, '', url); // optional: for back button
            })
            .catch(err => console.error("Error loading page:", err));
    });
});

// Handle form submissions dynamically (example: Create User)
document.addEventListener('submit', function(e){
    if(e.target && e.target.id === 'createUserForm'){
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);

        fetch('/CHL01/components/createUserContent.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(html => {
            content.innerHTML = html;
        })
        .catch(err => console.error(err));
    }
});

// Handle Back button click dynamically
document.addEventListener('click', function(e){
    if(e.target.closest('.back-btn')){
        // Load previous welcome page content
        fetch('components/welcome.php')
            .then(res => res.text())
            .then(html => {
                document.getElementById('page-content').innerHTML = html;
            })
            .catch(err => console.error(err));
    }
});
</script>

</body>
</html>
