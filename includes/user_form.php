<div class="card shadow-sm p-4 mb-4" style="max-width: 500px; background-color: #ffffff; border-radius: 16px;">
    <h3 class="mb-4 text-primary">Add New User</h3>
    <form action="create_user.php" method="POST">
        <div class="mb-3">
            <!--<label for="name" class="form-label fw-semibold">Name</label>-->
            <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Enter full name" required>
        </div>

        <div class="mb-3">
            <!--<label for="email" class="form-label fw-semibold">Email</label>-->
            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter email address" required>
        </div>

        <div class="mb-3">
            <!--<label for="company" class="form-label fw-semibold">Company Name</label>-->
            <input type="text" class="form-control form-control-lg" id="company" name="company" placeholder="Enter company name" required>
        </div>

        <div class="mb-3">
            <!--<label for="password" class="form-label fw-semibold">Password</label>-->
            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter password" required>
        </div>

        <div class="mb-4">
            <!--<label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>-->
            <input type="password" class="form-control form-control-lg" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100">Add User</button>
    </form>
</div>
