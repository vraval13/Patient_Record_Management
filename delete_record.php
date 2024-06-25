<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

if (isset($_GET['case_number'])) {
    $case_number = $_GET['case_number'];

    // Database connection
    $servername = "localhost";
    $username = "app_user";
    $password = "abcde";
    $dbname = "patient_records";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to delete the record
    $sql = "DELETE FROM patientrecords WHERE case_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $case_number);

    if ($stmt->execute()) {
        header("Location: patient_records.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No case number provided.";
}
?>
