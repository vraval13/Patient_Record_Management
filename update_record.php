<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

// Create database connection
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

$case_number = '';
$row = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['search'])) {
        // Collect the case number to search for
        $case_number = $_POST['case_number'];

        // Fetch existing data for the record
        $sql = "SELECT * FROM patientrecords WHERE case_number='$case_number'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        } else {
            echo "Record not found";
        }
    } elseif (isset($_POST['update'])) {
        // Collect form data for update
        $case_number = $_POST['case_number'];
        $date = $_POST['date'];
        $chief_complaint = $_POST['chief_complaint'];
        $physical_examination = $_POST['physical_examination'];
        $history = $_POST['history'];
        $diagnosis = $_POST['diagnosis'];
        $vital_signs = $_POST['vital_signs'];
        $medication = $_POST['medication'];
        $provider = $_POST['provider'];

        // Update record in the database
        $sql = "UPDATE patient_records SET 
                date='$date', 
                chief_complaint='$chief_complaint', 
                physical_examination='$physical_examination', 
                history='$history', 
                diagnosis='$diagnosis', 
                vital_signs='$vital_signs', 
                medication='$medication', 
                provider='$provider'
                WHERE case_number='$case_number'";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link rel="stylesheet" href="admin_panel.css">
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
            <li><a href="add_users.php">Add Users</a></li>
            <li><a href="user_logs.php">User Logs</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>Update Patient Record</h2>
            <div class="user-info">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <div class="content">
            <form action="update_record.php" method="POST">
                <div class="form-group">
                    <label for="case_number">Patient Case Number</label>
                    <input type="text" id="case_number" name="case_number" value="<?php echo htmlspecialchars($case_number); ?>" required>
                    <button type="submit" name="search">Search</button>
                </div>
            </form>

            <?php if ($row): ?>
            <form action="update_record.php" method="POST">
                <input type="hidden" name="case_number" value="<?php echo htmlspecialchars($row['case_number']); ?>">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($row['date']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="chief_complaint">Chief Complaint</label>
                    <input type="text" id="chief_complaint" name="chief_complaint" value="<?php echo htmlspecialchars($row['chief_complaint']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="physical_examination">Physical Examination</label>
                    <input type="text" id="physical_examination" name="physical_examination" value="<?php echo htmlspecialchars($row['physical_examination']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="history">History of Present Illness</label>
                    <input type="text" id="history" name="history" value="<?php echo htmlspecialchars($row['history']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="diagnosis">Diagnosis</label>
                    <input type="text" id="diagnosis" name="diagnosis" value="<?php echo htmlspecialchars($row['diagnosis']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="vital_signs">Vital Signs</label>
                    <textarea id="vital_signs" name="vital_signs" required><?php echo htmlspecialchars($row['vital_signs']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="medication">Medication/Treatment</label>
                    <input type="text" id="medication" name="medication" value="<?php echo htmlspecialchars($row['medication']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="provider">Attending Provider</label>
                    <select id="provider" name="provider" required>
                        <option value="">Select Doctor</option>
                        <option value="Physician1" <?php if ($row['provider'] == 'Physician1') echo 'selected'; ?>>Dr Gopal Raval</option>
                        <!-- Add other doctors here as needed -->
                    </select>
                </div>
                <button type="submit" name="update">Update</button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
