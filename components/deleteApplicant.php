<?php
require_once '../includes/db.php';

// Fetch selected applicants
$selectedSql = "SELECT id, applicantName, position, agreedSalary, joinDate FROM applicants WHERE LOWER(selection) = 'selected'";
$selectedResult = $conn->query($selectedSql);

// Fetch not selected applicants
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

    .btn {
      padding: 8px 14px;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .delete-btn {
      background-color: #dc3545;
      color: white;
    }

    .delete-btn:hover {
      background-color: #c82333;
    }

    .print-btn {
      background-color: #28a745;
      color: white;
    }

    .print-btn:hover {
      background-color: #218838;
    }

    .save-btn {
      background-color: #007bff;
      color: white;
    }

    .save-btn:hover {
      background-color: #0056b3;
    }

    input[type="date"] {
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .print-area {
      display: none;
    }

  </style>
</head>
<body>

<h2>Selected Applicants</h2>

<?php if ($selectedResult->num_rows > 0): ?>
  <form method="POST" action="saveJoinDates.php">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Position</th>
          <th>Agreed Salary</th>
          <th>Join Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $selectedResult->fetch_assoc()): ?>
          <tr id="row-<?= $row['id'] ?>">
            <td><?= htmlspecialchars($row['applicantName']) ?></td>
            <td><?= htmlspecialchars($row['position']) ?></td>
            <td><?= htmlspecialchars($row['agreedSalary']) ?></td>
            <td>
              <input type="date" name="joinDate[<?= $row['id'] ?>]" value="<?= $row['joinDate'] ?>">
            </td>
            <td>
              <button type="button" class="btn print-btn" onclick="printRow(<?= $row['id'] ?>)">Print</button>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <button type="submit" class="btn save-btn">Save Join Dates</button>
  </form>
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
            <form method="POST" action="delete_single_applicant.php" onsubmit="return confirm('Are you sure to delete this applicant?');">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button type="submit" class="btn delete-btn">Delete</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No not-selected applicants found.</p>
<?php endif; ?>


<!-- JavaScript to print one row -->
<script>
function printRow(id) {
  const row = document.getElementById('row-' + id);
  const cols = row.querySelectorAll('td');
  const name = cols[0].innerText;
  const position = cols[1].innerText;
  const salary = cols[2].innerText;
  const joinDate = cols[3].querySelector('input').value;

  const printContent = `
    <div style="font-family: Poppins, sans-serif; padding: 40px;">
      <h2>Selected Applicant</h2>
      <p><strong>Name:</strong> ${name}</p>
      <p><strong>Position:</strong> ${position}</p>
      <p><strong>Agreed Salary:</strong> ${salary}</p>
      <p><strong>Join Date:</strong> ${joinDate}</p>
    </div>
  `;

  const printWindow = window.open('', '', 'width=800,height=600');
  printWindow.document.write(printContent);
  printWindow.document.close();
  printWindow.focus();
  printWindow.print();
  printWindow.close();
}
</script>

</body>
</html>
