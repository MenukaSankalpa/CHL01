<?php
require_once '../includes/db.php';

function saveSignature($data, $prefix) {
    $data = str_replace('data:image/png;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $binary = base64_decode($data);

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $fileName = $uploadDir . $prefix . '_' . time() . '.png';
    file_put_contents($fileName, $binary);
    return $fileName;
}

$signatureFile  = saveSignature($_POST['signatureImage'], 'client');
$signature1Path = saveSignature($_POST['interviewer1Signature'], 'int1');
$signature2Path = saveSignature($_POST['interviewer2Signature'], 'int2');
$signature3Path = saveSignature($_POST['interviewer3Signature'], 'int3');

// CV file upload handler
$cvFilePath = '';
if (isset($_FILES['cvFile']) && $_FILES['cvFile']['error'] === UPLOAD_ERR_OK) {
    $cvTmpPath = $_FILES['cvFile']['tmp_name'];
    $cvName = basename($_FILES['cvFile']['name']);
    $cvExtension = pathinfo($cvName, PATHINFO_EXTENSION);

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $cvFileName = 'cv_' . time() . '.' . $cvExtension;
    $cvFilePath = $uploadDir . $cvFileName;

    move_uploaded_file($cvTmpPath, $cvFilePath);
}

// Extract marks and form data
$appearance     = $_POST['mark'][0];
$communication  = $_POST['mark'][1];
$experience     = $_POST['mark'][2];
$qualification  = $_POST['mark'][3];
$interest       = $_POST['mark'][4];
$totalMarks     = $_POST['mark'][5];

extract($_POST);

$sql = "INSERT INTO applicants (
    applicantName, homeTown, age, status, familyDetails, leaving, performance,experienceYears,
    appearance, communication, experience, qualification, interest, totalMarks,
    noticePeriod, presentSalary, expectedSalary, possibleWork,
    capital_question,
    interviewer1Name, interviewer1Designation, interviewer1Date,
    interviewer2Name, interviewer2Designation, interviewer2Date,
    interviewer3Name, interviewer3Designation, interviewer3Date,
    dateAppointment, position, companyName, agreedSalary, benefits,
    approval, name, aDesignation, aDate,
    signaturePath, cvPath
) VALUES (?, ?, ?, ?, ?, ?, ?, ?,
          ?, ?, ?, ?, ?, ?,
          ?, ?, ?, ?,
          ?,
          ?, ?, ?,
          ?, ?, ?,
          ?, ?, ?,
          ?, ?, ?, ?, ?,
          ?, ?, ?, ?,
          ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssisssssiiiiiiiiisssssssssssssssissssss",
    $applicantName, $homeTown, $age, $status, $familyDetails, $leaving, $performance, $experienceYears,
    $appearance, $communication, $experience, $qualification, $interest, $totalMarks,
    $noticePeriod, $presentSalary, $expectedSalary, $possibleWork,
    $capital_question,
    $interviewer1Name, $interviewer1Designation, $interviewer1Date,
    $interviewer2Name, $interviewer2Designation, $interviewer2Date,
    $interviewer3Name, $interviewer3Designation, $interviewer3Date,
    $dateAppoinment, $position, $companyName, $agreedSalary, $benefits,
    $approval, $name, $aDesignation, $aDate,
    $signatureFile, $cvFilePath
);

/*if ($stmt->execute()) {
    echo '<div style="color: green; font-weight: bold;">Data saved successfully!</div>';
    echo "<p>Signature saved at: <a href='$signatureFile' target='_blank'>View Signature</a></p>";
    echo "<p>CV saved at: <a href='$cvFilePath' target='_blank'>View CV</a></p>";
} else {
    echo '<div style="color: red; font-weight: bold;">Error saving data: ' . $stmt->error . '</div>';
}*/

// Top-right main menu button (fixed position)
echo '<div style="position: absolute; top: 20px; right: 20px;">
        <a href="main_menu.php" style="
          padding: 10px 20px;
          background-color: #007BFF;
          color: white;
          font-weight: bold;
          text-decoration: none;
          border-radius: 8px;
          box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
          transition: background-color 0.3s;
        " onmouseover="this.style.backgroundColor=\'#0056b3\'" onmouseout="this.style.backgroundColor=\'#007BFF\'">
          Main Menu
        </a>
      </div>';

echo '
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
    background-color: #f4f8fb;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
  }

  .menu-btn {
    position: absolute;
    top: 20px;
    right: 20px;
  }

  .menu-btn a {
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    font-weight: bold;
    text-decoration: none;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
    transition: background-color 0.3s ease;
  }

  .menu-btn a:hover {
    background-color: #0056b3;
  }

  .message-box {
    max-width: 600px;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    text-align: center;
  }

  .success {
    background-color: #e6f0ff;
    border-left: 6px solid #007BFF;
    color: #004085;
  }

  .error {
    background-color: #f8d7da;
    border-left: 6px solid #dc3545;
    color: #721c24;
  }

  .message-box a {
    color: #007BFF;
    text-decoration: underline;
  }

  h2 {
    margin-top: 0;
  }
</style>

<div class="menu-btn">
  <a href="../dashboard.php.php">Main Menu</a>
</div>
';

if ($stmt->execute()) {
    echo '
    <div class="message-box success">
      <h2> Data saved successfully!</h2>
      <p>Signature saved at: <a href="' . $signatureFile . '" target="_blank">View Signature</a></p>
      <p>CV saved at: <a href="' . $cvFilePath . '" target="_blank">View CV</a></p>
    </div>';
} else {
    echo '
    <div class="message-box error">
      <h2> Error saving data</h2>
      <p>' . $stmt->error . '</p>
    </div>';
}



$conn->close();
?>
