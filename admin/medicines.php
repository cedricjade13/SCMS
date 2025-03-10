<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Get the username from the session
} else {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
// Initialize an array to hold medicine data (in a real application, this would come from a database)
$medicines = [];

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect medicine data from the form
    $medicineData = [
        'name' => htmlspecialchars($_POST['name']),
        'dosage' => htmlspecialchars($_POST['dosage']),
        'quantity' => htmlspecialchars($_POST['quantity']),
        'expiry_date' => htmlspecialchars($_POST['expiry_date']),
        'description' => htmlspecialchars($_POST['description']),
    ];

    // Add the medicine data to the array (in a real application, you would save this to a database)
    if (!empty($medicineData['name'])) {
        $medicines[] = $medicineData; // Add the new medicine data to the array
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Medicines</title>
    <link rel="stylesheet" href="styles.css">
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
                        <li><a href="medicines.php">Add Medicines</a></li> <!-- Updated link to medicines.php -->
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
            <h2>Add Medicines</h2>
            <form method="POST" action="medicines.php">
                <h3>Medicine Information:</h3>
                
                <label for="name">Medicine Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="dosage">Dosage:</label>
                <input type="text" id="dosage" name="dosage" required>
                
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>
                
                <label for="expiry_date">Expiry Date:</label>
                <input type="date" id="expiry_date" name="expiry_date" required>
                
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>

                <input type="submit" value="Add Medicine">
            </form>

            <ul>
                <?php foreach ($medicines as $medicine): ?>
                    <li>
                        <strong><?php echo $medicine['name']; ?></strong><br>
                        Dosage: <?php echo $medicine['dosage']; ?><br>
                        Quantity: <?php echo $medicine['quantity']; ?><br>
                        Expiry Date: <?php echo $medicine['expiry_date']; ?><br>
                        Description: <?php echo $medicine['description']; ?><br>
                    </li>
                <?php endforeach; ?>
            </ul>
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