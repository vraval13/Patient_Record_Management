<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

$servername = "localhost";
$username = "app_user";
$password = "abcde";
$dbname = "patient_records";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['update'])) {
    $case_number = $_POST['case_number'];
    $date = $_POST['date'];
    $chief_complaint = $_POST['chief_complaint'];
    $physical_examination = $_POST['physical_examination'];
    $history = $_POST['history'];
    $diagnosis = $_POST['diagnosis'];
    $vital_signs = $_POST['vital_signs'];
    $medication = $_POST['medication'];
    $provider = $_POST['provider'];

    $sql = "UPDATE patientrecords SET date=?, chief_complaint=?, physical_examination=?, history=?, diagnosis=?, vital_signs=?, medication=?, provider=? WHERE case_number=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $date, $chief_complaint, $physical_examination, $history, $diagnosis, $vital_signs, $medication, $provider, $case_number);

    if ($stmt->execute()) {
        header("Location: patient_records.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
} else if (isset($_GET['case_number'])) {
    $case_number = $_GET['case_number'];
    $sql = "SELECT * FROM patientrecords WHERE case_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $case_number);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
} else {
    echo "No case number provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link rel="stylesheet" href="admin_panel.css">
</head>
<body>
    <div class="main-content">
        <div class="header">
            <h2>Edit Patient Record</h2>
        </div>
        <div class="content">
            <form method="POST" action="edit_record.php">
                <input type="hidden" name="case_number" value="<?php echo $record['case_number']; ?>">
                <label for="date">Date:</label>
                <input type="date" name="date" value="<?php echo $record['date']; ?>" required>
                <label for="chief_complaint">Chief Complaint:</label>
                <input type="text" name="chief_complaint" value="<?php echo $record['chief_complaint']; ?>" required>
                <label for="physical_examination">Physical Examination:</label>
                <input type="text" name="physical_examination" value="<?php echo $record['physical_examination']; ?>" required>
                <label for="history">History:</label>
                <input type="text" name="history" value="<?php echo $record['history']; ?>" required>
                <label for="diagnosis">Diagnosis:</label>
                <input type="text" name="diagnosis" value="<?php echo $record['diagnosis']; ?>" required>
                <label for="vital_signs">Vital Signs:</label>
                <input type="text" name="vital_signs" value="<?php echo $record['vital_signs']; ?>" required>
                <label for="medication">Medication:</label>
                <input type="text" name="medication" value="<?php echo $record['medication']; ?>" required>
                <label for="provider">Provider:</label>
                <input type="text" name="provider" value="<?php echo $record['provider']; ?>" required>
                <button type="submit" name="update">Update Record</button>
            </form>
        </div>
    </div>
</body>
</html>
