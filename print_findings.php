<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $case_number = $_POST['case_number'];
    $date = $_POST['date'];
    $chief_complaint = $_POST['chief_complaint'];
    $physical_examination = $_POST['physical_examination'];
    $history = $_POST['history'];
    $diagnosis = $_POST['diagnosis'];
    $vital_signs = $_POST['vital_signs'];
    $medication = $_POST['medication'];
    $provider = $_POST['provider'];
} else {
    // Redirect if the form is not submitted properly
    header("Location: admin_panel.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Findings</title>
    <link rel="stylesheet" href="print.css">
    <style>
        .print-container {
            width: 80%;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Arial', sans-serif;
        }

        .print-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .print-group {
            margin-bottom: 15px;
        }

        .print-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .print-group p {
            margin: 0;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <h2>Patient Findings</h2>
        <div class="print-group">
            <label>Patient Case Number</label>
            <p><?php echo htmlspecialchars($case_number); ?></p>
        </div>
        <div class="print-group">
            <label>Date</label>
            <p><?php echo htmlspecialchars($date); ?></p>
        </div>
        <div class="print-group">
            <label>Chief Complaint</label>
            <p><?php echo htmlspecialchars($chief_complaint); ?></p>
        </div>
        <div class="print-group">
            <label>Physical Examination</label>
            <p><?php echo htmlspecialchars($physical_examination); ?></p>
        </div>
        <div class="print-group">
            <label>History of Present Illness</label>
            <p><?php echo htmlspecialchars($history); ?></p>
        </div>
        <div class="print-group">
            <label>Diagnosis</label>
            <p><?php echo htmlspecialchars($diagnosis); ?></p>
        </div>
        <div class="print-group">
            <label>Vital Signs</label>
            <p><?php echo nl2br(htmlspecialchars($vital_signs)); ?></p>
        </div>
        <div class="print-group">
            <label>Medication/Treatment</label>
            <p><?php echo htmlspecialchars($medication); ?></p>
        </div>
        <div class="print-group">
            <label>Attending Provider</label>
            <p><?php echo htmlspecialchars($provider); ?></p>
        </div>
        <button class="print-button" onclick="window.print()">Print</button>
    </div>
</body>
</html>
