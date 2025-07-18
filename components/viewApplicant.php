<?php
require_once '../includes/db.php';

$sql = "SELECT id, applicantName, experienceYears, appearance, communication, experience, qualification, interest, totalMarks, presentSalary, expectedSalary, noticePeriod, selection FROM applicants ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>VIEW APPLICANT</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      padding: 40px;
      background-color: #f0f4f8;
      color: #333;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #0056b3;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 14px 12px;
      text-align: center;
    }

    th {
      background-color: #007BFF;
      color: #fff;
      font-weight: 600;
      font-size: 15px;
    }

    tr:nth-child(even):not(.selected-row) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #e6f0ff;
    }

    .selected-row {
      background-color: #d4edda !important;
      color: #2d8231ff;
      font-weight: 500;
    }

    select {
      padding: 6px 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-family: 'Poppins', sans-serif;
    }

    .save-wrapper {
      text-align: right;
      margin-top: 20px;
      padding-right: 20px;
    }

   .save-button {
     padding: 10px 20px;
     font-size: 16px;
     background-color: #007BFF;
     color: white;
     border: none;
     border-radius: 6px;
     cursor: pointer;
     transition: background 0.3s ease;
   }

   .save-button:hover {
     background-color: #0056b3;
   }
   
  </style>
</head>
<body>

<h2>APPLICANT SUMMERY</h2>

<?php if ($result->num_rows > 0): ?>
  <form id="bulkForm">
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
          <?php
            $isSelected = strtolower(trim($row['selection'])) === 'selected';
            $rowClass = $isSelected ? 'selected-row' : '';
          ?>
          <tr class="<?= $rowClass ?>">
            <td><?= htmlspecialchars($row["applicantName"]) ?></td>
            <td><?= htmlspecialchars($row["experienceYears"]) ?></td>
            <td><?= htmlspecialchars($row["appearance"]) ?></td>
            <td><?= htmlspecialchars($row["communication"]) ?></td>
            <td><?= htmlspecialchars($row["experience"]) ?></td>
            <td><?= htmlspecialchars($row["qualification"]) ?></td>
            <td><?= htmlspecialchars($row["interest"]) ?></td>
            <td><?= htmlspecialchars($row["totalMarks"]) ?></td>
            <td><?= htmlspecialchars($row["presentSalary"]) ?></td>
            <td><?= htmlspecialchars($row["expectedSalary"]) ?></td>
            <td><?= htmlspecialchars($row["noticePeriod"]) ?></td>
            <td>
              <select name="selection[<?= $row['id'] ?>]" required>
                <option value="">Status</option>
                <option value="Selected" <?= $isSelected ? 'selected' : '' ?>>Selected</option>
                <option value="Not Selected" <?= strtolower($row['selection']) === 'not selected' ? 'selected' : '' ?>>Not Selected</option>
              </select>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <div class="save-wrapper">
        <button type="submit" class="save-button">Save</button>
    </div>

    <!--<button type="submit" class="save-button">Save</button>-->
  </form>
<?php else: ?>
  <p>No applicants found.</p>
<?php endif; ?>

<script>
  document.getElementById('bulkForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('updateDesicion.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(data => {
      alert("All data saved successfully!");
      window.location.href = "../dashboard.php";
    })
    .catch(err => {
      alert("Error saving decisions.");
    });
  });
</script>

</body>
</html>
