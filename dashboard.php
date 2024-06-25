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
    <title>Dashboard</title>
    <link rel="stylesheet" href="admin_panel.css">
    <style>
      /* Basic styling for the layout */

/* Sidebar */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    background-color: #333;
    color: #fff;
    padding-top: 50px;
}

.sidebar-header {
    text-align: center;
    padding: 10px 0;
}

.sidebar-menu {
    list-style-type: none;
    padding: 0;
}

.sidebar-menu li {
    padding: 10px;
}

.sidebar-menu li a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 10px;
    transition: 0.3s;
}

.sidebar-menu li a:hover {
    background-color: #555;
}

/* Main Content */
.main-content {
    margin-left: 250px;
    padding: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.user-info {
    display: flex;
    align-items: center;
}

.logout-btn {
    background-color: #dc3545;
    color: #fff;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
}

.logout-btn:hover {
    background-color: #c82333;
}

/* Additional styling for introduction and dashboard content */
.intro {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.intro h3 {
    color: #333;
    margin-bottom: 10px;
}

.dashboard-info {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Animations (Example: Fade in on load) */
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
            <!-- <li><a href="add_records.php">Add Records</a></li> -->
            <li><a href="add_users.php">Add Users</a></li>
            <li><a href="user_logs.php">User Logs</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <h2>Dashboard</h2>
            <div class="user-info">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
        <div class="content">
            <div class="intro">
                <h3>Welcome to Shilp Chest Disease Centre, led by the renowned Dr. Gopal Raval.</h3>
                <p>Here at Shilp, we are dedicated to delivering exceptional care and cutting-edge treatments for chest diseases. Our mission is to provide compassionate, patient-centered care while advancing the field of pulmonology through innovative research and education.</p>
                <p>Dr. Gopal Raval, our esteemed Director, brings a wealth of experience and a visionary approach to healthcare. Under his leadership, Shilp Chest Disease Centre has become a beacon of excellence, known for its state-of-the-art facilities and a multidisciplinary team of experts committed to improving patient outcomes. Dr. Raval's dedication to clinical excellence and his groundbreaking contributions to the field have set new standards in the diagnosis, treatment, and management of chest diseases.</p>
                <p>Join us at Shilp Chest Disease Centre, where we combine expertise, compassion, and innovation to enhance the lives of our patients.</p>
            </div>
            <div class="dashboard-info">
                <p>Welcome to the dashboard! Use the sidebar to navigate through the system.</p>
            </div>
        </div>
    </div>
</body>
</html>
