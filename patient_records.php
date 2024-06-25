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

$sql = "SELECT * FROM patientrecords";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Records Table</title>
    <link rel="stylesheet" href="admin_panel.css">
    <style>
        .main-content {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: green; }
        .action-btns { display: flex; gap: 10px; }
        .action-btns a { text-decoration: none; padding: 5px 10px; color: white; border-radius: 5px; }
        .edit-btn { background-color: #4CAF50; }
        .delete-btn { background-color: #f44336; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="admin_panel.php"><h3 style="color: white;">PATIENT RECORDS</h3></a>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="patient_records.php">Patient Records Table</a></li>
            <li><a href="find_record.php">Find Record</a></li>
            <li><a href="update_record.php">Update Record</a></li>
            <!-- <li><a href="add_records.php">Add Records</a></li> -->
            <li><a href="add_users.php">Add Users</a></li>
            <li><a href="user_logs.php">User Logs</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <h2>Patient Records Table</h2>
            <div class="user-info">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>Case Number</th>
                    <th>Date</th>
                    <th>Chief Complaint</th>
                    <th>Physical Examination</th>
                    <th>History</th>
                    <th>Diagnosis</th>
                    <th>Vital Signs</th>
                    <th>Medication</th>
                    <th>Provider</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['case_number'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['chief_complaint'] . "</td>";
                        echo "<td>" . $row['physical_examination'] . "</td>";
                        echo "<td>" . $row['history'] . "</td>";
                        echo "<td>" . $row['diagnosis'] . "</td>";
                        echo "<td>" . $row['vital_signs'] . "</td>";
                        echo "<td>" . $row['medication'] . "</td>";
                        echo "<td>Dr. Gopal Raval</td>";
                        echo "<td class='action-btns'>";
                        echo "<a href='edit_record.php?case_number=" . $row['case_number'] . "' class='edit-btn'>Edit</a>";
                        echo "<a href='delete_record.php?case_number=" . $row['case_number'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No records found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
