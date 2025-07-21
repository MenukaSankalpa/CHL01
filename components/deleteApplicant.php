<?php
require_once '../includes/db.php';

$selectedSql = "SELECT id, applicantName, position, agreedSalary, joinDate FROM applicants WHERE LOWER(selection) = 'selected'";
$selectedResult = $conn->query($selectedSql);


$notSelectedSql = "SELECT id, applicantName, position, agreedSalary FROM applicants WHERE LOWER(selection) = 'not selected'";
$notSelectedResult = $conn->query($notSelectedSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete Applicants</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f0f4f8;
      padding: 30px;
    }

    h2 {
      color: #0056b3;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      margin-bottom: 40px;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 14px 12px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }

    th {
      background-color: #007BFF;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    button, .print-btn {
      padding: 8px 16px;
      background-color: #dc3545;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .print-btn {
      background-color: #28a745;
      margin-bottom: 10px;
    }

    button:hover {
      background-color: #c82333;
    }

    .print-btn:hover {
      background-color: #218838;
    }

  </style>
</head>
<body>

<h2>Selected Applicants</h2>

<?php if ($selectedResult->num_rows > 0): ?>
  <button class="print-btn" onclick="window.print()">Print</button>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Agreed Salary</th>
        <th>Join Date</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $selectedResult->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['applicantName']) ?></td>
          <td><?= htmlspecialchars($row['position']) ?></td>
          <td><?= htmlspecialchars($row['agreedSalary']) ?></td>
          <td><?= htmlspecialchars($row['joinDate']) ?: '<em>Not Set</em>' ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No selected applicants found.</p>
<?php endif; ?>

<h2>Not Selected Applicants</h2>

<?php if ($notSelectedResult->num_rows > 0): ?>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Agreed Salary</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $notSelectedResult->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['applicantName']) ?></td>
          <td><?= htmlspecialchars($row['position']) ?></td>
          <td><?= htmlspecialchars($row['agreedSalary']) ?></td>
          <td>
            <form method="POST" action="delete_single_applicant.php" onsubmit="return confirm('Are you sure you want to delete this applicant?');">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button type="submit">Delete</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No not-selected applicants found.</p>
<?php endif; ?>

</body>
</html>
