<?php
include __DIR__ . '/../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .content { margin: 20px; }
        .modal-overlay { display: none; justify-content: center; align-items: center; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.35); z-index:1000; }
        .modal-box { background: #fff; border-radius:12px; padding:20px; width:360px; box-shadow:0 6px 20px rgba(0,0,0,0.2); position: relative; }
        .modal-box h5 { margin-bottom: 15px; }
        .close-btn { position:absolute; top:12px; right:12px; cursor:pointer; font-size:1.2rem; }
        .alert-success { display:none; }
    </style>
</head>
<body>
<div class="content">
    <h2>Users</h2>
    <button id="createUserBtn" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Create User</button>
    
    <div id="successMsg" class="alert alert-success">User created successfully!</div>

    <div class="table-responsive">
        <table id="usersTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<?php include __DIR__ . '/add_user.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/users.js"></script>
</body>
</html>
