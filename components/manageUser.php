<?php
include('../includes/db.php');
$msg = '';

if(isset($_POST['create_user'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $company_name = $_POST['company_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Password confirmation check
    if($password !== $confirm_password){
        $msg = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, company_name, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $company_name, $hashed_password);
        $stmt->execute() ? $msg="User created successfully!" : $msg="Error: ".$stmt->error;
        $stmt->close();
    }
}

$users = $conn->query("SELECT * FROM users");
?>

<div class="main-content">

    <!-- Back Button -->
    <button class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> Back
    </button>

    <div class="user-section">
        <h2><i class="fa-solid fa-users"></i> Manage Users</h2>
        <?php if($msg): ?><p class="msg"><?php echo $msg; ?></p><?php endif; ?>

        <!-- Create User Form -->
        <form id="createUserForm" method="POST">
            <div class="field-group">
                <div class="input-icon">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>
                <div class="input-icon">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email ID" required>
                </div>
            </div>
            <div class="field-group">
                <div class="input-icon">
                    <i class="fa-solid fa-building"></i>
                    <input type="text" name="company_name" placeholder="Company Name" required>
                </div>
                <div class="input-icon">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
            </div>
            <div class="field-group">
                <div class="input-icon">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                </div>
            </div>
            <button type="submit" name="create_user">
                <i class="fa-solid fa-user-plus"></i> Create User
            </button>
        </form>

        <!-- Users Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['company_name']); ?></td>
                    <td class="action-buttons">
                        <a href="editUserContent.php?id=<?php echo $row['id']; ?>" class="edit-btn">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="deleteUser.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this user?')" class="delete-btn">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Password Match Script -->
<script>
const password = document.getElementById('password');
const confirm_password = document.getElementById('confirm_password');

function checkPasswordMatch(){
    if(confirm_password.value === ""){
        confirm_password.style.borderColor = "#d1d5db"; // default gray
        return;
    }
    if(password.value === confirm_password.value){
        confirm_password.style.borderColor = "#22c55e"; // green
    } else {
        confirm_password.style.borderColor = "#ef4444"; // red
    }
}

password.addEventListener('input', checkPasswordMatch);
confirm_password.addEventListener('input', checkPasswordMatch);
</script>
