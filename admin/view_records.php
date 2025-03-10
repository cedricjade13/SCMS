<?php
session_start(); // Start the session

// Include the database configuration file
include('../database/config.php'); // Make sure this path is correct

// Initialize an array to hold patient data
$patients = [];

// Fetch patient data from the database
$sql = "SELECT * FROM patients"; // Adjust the table name if necessary
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch all patient records
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row; // Add each patient record to the array
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Records</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .main-content {
            flex: 1;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .patient-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Space between patient records */
        }
        .patient-record {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            background: #fff;
            width: calc(33.33% - 20px); /* Three records per row with gap */
            box-sizing: border-box; /* Include padding and border in width */
        }
        .patient-info {
            margin-bottom: 10px;
        }
        .patient-info label {
            font-weight: bold;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>SCMS</h2>
            <ul class="menu">
                <li>
                    <span class="toggle dashboard">Dashboard</span>
                </li>
                <li>
                    <span class="toggle">Patient</span>
                    <ul class="submenu">
                        <li><a href="patients.php">Add Patient</a></li>
                        <li><a href="view_records.php">View Records</a></li>
                        <li><a href="#search-filter-patients">Search & Filter Patients</a></li>
                        <li><a href="#edit-patient-info">Edit Patient Information</a></li>
                    </ul>
                </li>
                <li>
                    <span class="toggle">Medicine</span>
                    <ul class="submenu">
                        <li><a href="medicines.php">Add Medicines</a></li>
                        <li><a href="#search-filter-medicines">Search & Filter Medicines</a></li>
                        <li><a href="#expiry-date-tracking">Expiry Date Tracking</a></li>
                    </ul>
                </li>
                <li><a href="#settings">Settings</a></li>
            </ul>
            <a href="login.php" class="logout">Logout</a>
        </aside>
        
        <header class="header">
        <div class="admin-info">ADMINISTRATOR, <?php echo htmlspecialchars($username); ?></div> <!-- Admin info on the right -->
        </header>
        
        <main class="main-content">
            <h2>Patient Records</h2>
            <div class="patient-container">
                <?php foreach ($patients as $patient): ?>
                    <div class="patient-record">
                        <div class="patient-info">
                            <label>Full Name:</label> <?php echo htmlspecialchars($patient['full_name']); ?>
                        </div>
                        <div class="patient-info">
                            <label>DOB:</label> <?php echo htmlspecialchars($patient['dob']); ?>
                        </div>
                        <div class="patient-info">
                            <label>Gender:</label> <?php echo htmlspecialchars($patient['gender']); ?>
                        </div>
                        <div class="patient-info">
                            <label>Contact Number:</label> <?php echo htmlspecialchars($patient['contact_number']); ?>
                        </div>
                        <div class="patient-info">
                            <label>Email:</label> <?php echo htmlspecialchars($patient['email']); ?>
                        </div>
                        <div class="patient-info">
                            <label>Address:</label> <?php echo htmlspecialchars($patient['address']); ?>
                        </div>
                        <div class="patient-info">
                            <label>Blood Type:</label> <?php echo htmlspecialchars($patient['blood_type']); ?>
                        </div>
                        <div class="patient-info">
                            <label>Allergies:</label> <?php echo htmlspecialchars($patient['allergies']); ?>
                        </div>
                        <div class="patient-info">
                            <label>Assigned Doctor:</label> <?php echo htmlspecialchars($patient['assigned_doctor']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

    <script>
        // JavaScript to toggle submenu visibility
        const toggles = document.querySelectorAll('.toggle');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const submenu = toggle.nextElementSibling;
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
            });
        });

        document.querySelector(".toggle.dashboard").addEventListener("click", function() {
            window.location.href = "dashboard.php";
        });
    </script>
</body>
</html>