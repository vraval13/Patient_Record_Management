<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect search query
    $search_query = $_POST['search_query'];

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

    // Prepare SQL query
    $sql = "SELECT * FROM patientrecords 
            WHERE case_number LIKE '%$search_query%' 
            OR diagnosis LIKE '%$search_query%'";

    // Execute SQL query
    $result = $conn->query($sql);

    // Check if records were found
    if ($result->num_rows > 0) {
        // Display search results
        echo "<h2>Search Results</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Case Number</th>
                    <th>Date</th>
                    <th>Chief Complaint</th>
                    <th>Diagnosis</th>
                    <th>Actions</th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['case_number']) . "</td>
                    <td>" . htmlspecialchars($row['date']) . "</td>
                    <td>" . htmlspecialchars($row['chief_complaint']) . "</td>
                    <td>" . htmlspecialchars($row['diagnosis']) . "</td>
                    <td><a href='edit_record.php?record_id=" . $row['id'] . "'>Edit</a> | <a href='delete_record.php?record_id=" . $row['id'] . "'>Delete</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Record</title>
    <link rel="stylesheet" href="admin_panel.css">
    <style>
        .main-content {
    animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

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
            <li><a href="add_users.php">Add Users</a></li>
            <li><a href="user_logs.php">User Logs</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>Find Record</h2>
            <div class="user-info">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <div class="content">
            <form action="find_record.php" method="POST">
                <div class="form-group">
                    <label for="search_query">Search Query:</label>
                    <input type="text" id="search_query" name="search_query" required>
                </div>
                <button type="submit">Search</button>
            </form>
        </div>
    </div>
</body>
</html>
