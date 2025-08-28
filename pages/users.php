<?php
include $_SERVER['DOCUMENT_ROOT'] . '/CHL01/includes/header.php';
?>

<div class="page-area container mt-4" id="mainContent">
    <h1 class="mb-4">Users Management</h1>

    <!-- Action Buttons -->
    <div class="mb-4">
        <button id="addUserBtn" class="btn btn-primary me-2">Add User</button>
        <button id="viewUsersBtn" class="btn btn-outline-primary">View Users</button>
    </div>

    <!-- Content area -->
    <div id="userContent">
        <!-- Initially empty -->
    </div>
</div>

<script>
const userContent = document.getElementById('userContent');
const addBtn = document.getElementById('addUserBtn');
const viewBtn = document.getElementById('viewUsersBtn');

// Load Add User Form
addBtn.addEventListener('click', () => {
    userContent.innerHTML = `<?php echo addslashes(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/CHL01/includes/user_form.php')); ?>`;
});

// Load User Table
viewBtn.addEventListener('click', () => {
    userContent.innerHTML = `<?php echo addslashes(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/CHL01/includes/user_table.php')); ?>`;
});
</script>
