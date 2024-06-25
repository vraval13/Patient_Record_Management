<?php
$servername = "localhost";
$username = "app_user";
$password = "abcde";
$dbname = "patient_records";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection successful.<br>"; // Debugging statement
}
?>
