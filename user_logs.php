<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Logs</title>
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
            <!-- <li><a href="add_records.php">Add Records</a></li> -->
            <li><a href="add_users.php">Add Users</a></li>
            <li><a href="user_logs.php">User Logs</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <h2>User Logs</h2>
            <div class="user-info">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Timestamp</th>
                </tr>
                <!-- Loop through user logs here -->
            </table>
        </div>
    </div>
</body>
</html>
