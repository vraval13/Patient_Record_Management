<?php
session_start();

// Check if the user is logged in
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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_panel.css">

    <style>
        .main-content {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .sidebar {
            position: relative;
            height:150vh;
        }

        .advertising-poster {
            display: block;
            margin: 10px 0;
            text-align: center;
        }

        .advertising-poster img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .footer {
            background-color: #222;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="advertising-poster">
            <a href="https://drgopalraval.vercel.app" target="_blank">
                <img src="https://img.freepik.com/free-photo/comic-book-lifestyle-scene-illustration_23-2151133691.jpg?t=st=1719296163~exp=1719299763~hmac=76f80a4fd7a141a29fb653f5773759b0e16325079c64b2523c645f4ff34f5929&w=360" height="100" width="200" alt="Visit Dr. Gopal Raval's Website">
            </a>
            <p>Visit us :- Click on the above pic</p>
        </div>
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
            <h2>Out Patient Findings</h2>
            <div class="user-info">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
        <div class="content">
            <form action="process_findings.php" method="POST">
                <div class="form-group">
                    <label for="case_number">Patient Case Number</label>
                    <input type="text" id="case_number" name="case_number" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="chief_complaint">Chief Complaint</label>
                    <input type="text" id="chief_complaint" name="chief_complaint" required>
                </div>
                <div class="form-group">
                    <label for="physical_examination">Physical Examination</label>
                    <input type="text" id="physical_examination" name="physical_examination" required>
                </div>
                <div class="form-group">
                    <label for="history">History of Present Illness</label>
                    <input type="text" id="history" name="history" required>
                </div>
                <div class="form-group">
                    <label for="diagnosis">Diagnosis</label>
                    <input type="text" id="diagnosis" name="diagnosis" required>
                </div>
                <div class="form-group">
                    <label for="vital_signs">Vital Signs</label>
                    <textarea id="vital_signs" name="vital_signs" required></textarea>
                </div>
                <div class="form-group">
                    <label for="medication">Medication/Treatment</label>
                    <input type="text" id="medication" name="medication" required>
                </div>
                <div class="form-group">
                    <label for="provider">Attending Provider</label>
                    <select id="provider" name="provider" required>
                        <option value="">Select Doctor</option>
                        <option value="Physician1">Dr Gopal Raval</option>
                    </select>
                </div>
                <button type="submit" name="submit">Submit</button>
                <button type="submit" name="print" formaction="print_findings.php">Generate Print Format</button>
            </form>
        </div>
    </div>
    <div class="footer">
        © 2024 Created with ♥ By <a href="https://www.instagram.com/cool_guy_0304/" target="__blank">Vyom Raval</a> | Terms & conditions
    </div>
</body>
</html>
