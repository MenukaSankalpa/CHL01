<?php
$conn = new mysqli("localhost", "root", "", "hr_applications"); // Change DB name if needed

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//signature saving
$signatureFile = '';
if (!empty($_POST['signatureImage'])) {
    $signatureData = $_POST['signatureImage'];
    $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
    $signatureData = str_replace(' ', '+', $signatureData);
    $signatureBinary = base64_decode($signatureData);

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $signatureFile = $uploadDir . 'signature_' . time() . '.png';
    file_put_contents($signatureFile, $signatureBinary);
}

extract($_POST);

$sql = "INSERT INTO applicants (
    applicantName, homeTown, age, status, familyDetails, leaving, performance,
    appearance, communication, experience, qualification, interest, totalMarks,
    noticePeriod, presentSalary, expectedSalary, possibleWork,
    capital_question,
    interviewer1Name, interviewer1Designation, interviewer1Date,
    interviewer2Name, interviewer2Designation, interviewer2Date,
    interviewer3Name, interviewer3Designation, interviewer3Date,
    dateAppointment, position, companyName, agreedSalary, benefits,
    approval, name, aDesignation, aDate,
    signaturePath
) VALUES (?, ?, ?, ?, ?, ?, ?,
          ?, ?, ?, ?, ?, ?,
          ?, ?, ?, ?,
          ?,
          ?, ?, ?,
          ?, ?, ?,
          ?, ?, ?,
          ?, ?, ?, ?, ?,
          ?, ?, ?, ?,
          ?)";


$stmt = $conn->prepare($sql);

$appearance = $_POST['mark'][0];
$communication = $_POST['mark'][1];
$experience = $_POST['mark'][2];
$qualification = $_POST['mark'][3];
$interest = $_POST['mark'][4];
$totalMarks = $_POST['mark'][5];

$stmt->bind_param("ssissssiiiiiiiiisssssssssssssssisssss",
    $applicantName, $homeTown, $age, $status, $familyDetails, $leaving, $performance,
    $appearance, $communication, $experience, $qualification, $interest, $totalMarks,
    $noticePeriod, $presentSalary, $expectedSalary, $possibleWork,
    $capital_question,
    $interviewer1Name, $interviewer1Designation, $interviewer1Date,
    $interviewer2Name, $interviewer2Designation, $interviewer2Date,
    $interviewer3Name, $interviewer3Designation, $interviewer3Date,
    $dateAppoinment, $position, $companyName, $agreedSalary, $benefits,
    $approval, $name, $aDesignation, $aDate,
    $signatureFile
);


if ($stmt->execute()) {
    echo "<h2>Data saved successfully!</h2>";
    echo "<p>Signature saved at: <a href='$signatureFile' target='_blank'>View Signature</a></p>";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
