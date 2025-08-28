<div class="card shadow-sm p-3" style="background-color: #ffffff; border-radius: 16px;">
    <h3 class="mb-4 text-primary">User List</h3>
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Company Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Example users (replace with DB query)
            $users = [
                ['id'=>1, 'name'=>'John Doe', 'email'=>'john@example.com', 'company'=>'ABC Corp'],
                ['id'=>2, 'name'=>'Jane Smith', 'email'=>'jane@example.com', 'company'=>'XYZ Ltd'],
            ];
            foreach ($users as $index => $user) {
                echo "<tr>
                    <td>".($index+1)."</td>
                    <td>{$user['name']}</td>
                    <td>{$user['email']}</td>
                    <td>{$user['company']}</td> <!-- Display company -->
                    <td>
                        <button class='btn btn-sm btn-warning me-1'>Edit</button>
                        <button class='btn btn-sm btn-danger'>Delete</button>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
