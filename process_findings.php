<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $case_number = $_POST['case_number'];
    $date = $_POST['date'];
    $chief_complaint = $_POST['chief_complaint'];
    $physical_examination = $_POST['physical_examination'];
    $history = $_POST['history'];
    $diagnosis = $_POST['diagnosis'];
    $vital_signs = $_POST['vital_signs'];
    $medication = $_POST['medication'];
    $provider = $_POST['provider'];  // Assuming this is the doctor's name or ID

    // Database credentials
    $servername = "localhost";
    $username = "app_user";
    $password = "abcde";
    $dbname = "patient_records";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the case number already exists
    $check_query = "SELECT * FROM patientrecords WHERE case_number = '$case_number'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Error: Case number already exists. Please use a unique case number.";
    } else {
        // SQL to insert data into patient records table
        $sql = "INSERT INTO patientrecords (case_number, date, chief_complaint, physical_examination, history, diagnosis, vital_signs, medication, provider)
                VALUES ('$case_number', '$date', '$chief_complaint', '$physical_examination', '$history', '$diagnosis', '$vital_signs', '$medication', '$provider')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
