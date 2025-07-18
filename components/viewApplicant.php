<?php
$conn = new mysqli("localhost", "root", "", "hr_applications");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all applicants (you can limit or filter later)
$sql = "SELECT id, applicantName, experienceYears, appearance, communication, experience, qualification, interest, totalMarks, presentSalary, expectedSalary, noticePeriod FROM applicants ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Applicants</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #f9f9f9;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    th, td {
      border: 1px solid #aaa;
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: #007BFF;
      color: white;
    }

    select {
      padding: 5px;
    }

    .decision-form {
      display: inline-block;
    }

    .success {
      color: green;
    }

    .danger {
      color: red;
    }
  </style>
</head>
<body>
  <h2>Applicant Summary</h2>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>Applicant Name</th>
          <th>Experience</th>
          <th>Appearance</th>
          <th>Communication</th>
          <th>Experience Marks</th>
          <th>Qualification</th>
          <th>Interest</th>
          <th>Total Marks</th>
          <th>Present Salary</th>
          <th>Expected Salary</th>
          <th>Notice Period</th>
          <th>Decision</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row["applicantName"]) ?></td>
            <td><?= htmlspecialchars($row["experienceYears"]) ?></td>
            <td><?= $row["appearance"] ?></td>
            <td><?= $row["communication"] ?></td>
            <td><?= $row["experience"] ?></td>
            <td><?= $row["qualification"] ?></td>
            <td><?= $row["interest"] ?></td>
            <td><?= $row["totalMarks"] ?></td>
            <td><?= $row["presentSalary"] ?></td>
            <td><?= $row["expectedSalary"] ?></td>
            <td><?= $row["noticePeriod"] ?></td>
            <td>
              <form class="decision-form" method="POST" action="update_decision.php">
                <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                <select name="selection">
                  <option value="">Select</option>
                  <option value="Selected">Selected</option>
                  <option value="Not Selected">Not Selected</option>
                </select>
                <button type="submit">Save</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No applicants found.</p>
  <?php endif; ?>

<?php $conn->close(); ?>
</body>
</html>
