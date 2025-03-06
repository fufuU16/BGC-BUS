<?php
include 'db_connection.php';

$busDetails = null;

if (isset($_GET['bus_id'])) {
    $busId = $_GET['bus_id'];

    // Query to fetch bus details including TotalOdometer
    $detailsQuery = "SELECT *, TotalOdometer FROM bus_details WHERE bus_id = ?";
    if ($stmt = $conn->prepare($detailsQuery)) {
        $stmt->bind_param("s", $busId);
        $stmt->execute();
        $result = $stmt->get_result();
        $busDetails = $result->fetch_assoc() ?: null;
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentDate = date('Y-m-d');
    $updateType = $_POST['update_type'] ?? null;
    $newOdometer = isset($_POST['odometer']) && is_numeric($_POST['odometer']) ? $_POST['odometer'] : null;

    $fieldsToUpdate = array_filter([
        'TotalOdometer' => $newOdometer,
        'AfterMaintenanceOdometer' => ($updateType === 'maintenance') ? $newOdometer : null,
        'daily_usage' => $_POST['daily_usage'] ?? null,
        'current_status' => $_POST['current_status'] ?? null,
        'driver1' => $_POST['driver1'] ?? null,
        'driver2' => $_POST['driver2'] ?? null,
        'registration_expiry' => $_POST['registration_expiry'] ?? null,
        'safety_inspection_date' => $_POST['safety_inspection_date'] ?? null,
        'last_maintenance' => ($updateType === 'maintenance') ? $currentDate : null
    ], fn($value) => $value !== null);

    if ($fieldsToUpdate) {
        $updateQuery = "UPDATE bus_details SET " . implode(", ", array_map(fn($key) => "$key = ?", array_keys($fieldsToUpdate))) . " WHERE bus_id = ?";
        if ($stmt = $conn->prepare($updateQuery)) {
            $values = array_values($fieldsToUpdate);
            $values[] = $busId;

            $types = str_repeat("s", count($values));
            if ($newOdometer !== null) {
                $types[0] = "i";
            }

            $stmt->bind_param($types, ...$values);
            if (!$stmt->execute()) {
                die("MySQL Error: " . $stmt->error);
            }
            $stmt->close();
        }
    }

    // Update maintenance_data table
    if (in_array($updateType, ['oil_change', 'tire_replacement', 'brake_replacement'])) {
        $maintenanceType = ucfirst(str_replace('_', ' ', $updateType));
        $status = 'Done';

        // Use TotalOdometer as odometer_at_maintenance
        $odometerAtMaintenance = $busDetails['TotalOdometer'] ?? $newOdometer;

        $maintenanceQuery = "INSERT INTO maintenance_data (bus_id, last_maintenance, TypeofMaintenance, status, odometer_at_maintenance) VALUES (?, ?, ?, ?, ?)
                             ON DUPLICATE KEY UPDATE last_maintenance = VALUES(last_maintenance), status = VALUES(status), odometer_at_maintenance = VALUES(odometer_at_maintenance)";
        if ($stmt = $conn->prepare($maintenanceQuery)) {
            $stmt->bind_param("ssssi", $busId, $currentDate, $maintenanceType, $status, $odometerAtMaintenance);
            if (!$stmt->execute()) {
                die("MySQL Error: " . $stmt->error);
            }
            $stmt->close();
        }
    }

    header("Location: Busdetails.php?bus_id=" . $busId);
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bus Details</title>
    <link rel="stylesheet" href="EditBusdetails.css">
    <script>
        function toggleFields() {
            document.querySelectorAll('.update-field').forEach(field => field.style.display = 'none');
            const updateType = document.querySelector('select[name="update_type"]').value;
            if (updateType) {
                document.getElementById(updateType + '-field').style.display = 'block';
            }
        }
    </script>
</head>
<body>
    <header>
       
          
    <?php session_start();
        if (!isset($_SESSION['username'])) {
            // Redirect to login page if not logged in
            header("Location: Login.php");
            exit();
        } ?>
        <nav>
            <a href="Dashboard.php">Dashboard</a>
            <a href="Shiftlogs.php">Shift Logs</a>
            <a href="Maintenance.php">Maintenance</a>
            <a href="Passenger.php">Passengers</a>
            <a href="Feedback.php" >Feedback</a>

            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>
    
    <main>
        <div class="Title">
            <h1>Edit Bus Details</h1>
        </div>
        
        <div id="EditBusdetails">
            <?php if ($busDetails): ?>
                <form method="POST">
                    <div class="detail-item">
                        <label for="update_type">Update Type:</label>
                        <select name="update_type" onchange="toggleFields()">
                            <option value="">Select Update Type</option>
                            <option value="odometer">Odometer Update</option>
                            <option value="maintenance">Maintenance Update</option>
                            <option value="update_drivers">Update Drivers</option>
                            <option value="tire_replacement">Tire Replacement</option>
                            <option value="oil_change">Oil Change</option>
                            <option value="brake_replacement">Brake Replacement</option>
                        </select>
                    </div>
                    <div class="detail-item update-field" id="odometer-field" style="display: none;">
                        <label for="odometer">Current Odometer Reading:</label>
                        <input type="text" name="odometer">
                    </div>
                    <div class="detail-item update-field" id="update_drivers-field" style="display: none;">
                        <label for="driver1">Driver 1:</label>
                        <input type="text" name="driver1">
                        <label for="driver2">Driver 2:</label>
                        <input type="text" name="driver2">
                    </div>
                    <!-- Removed individual update buttons -->
                    <div class="detail-item">
                        <label for="current_status">Current Status:</label>
                        <select name="current_status">
                            <option value="operational">Operational</option>
                            <option value="under_maintenance">Under Maintenance</option>
                        </select>
                    </div>
                    <button type="submit">Save Changes</button>
                </form>
            <?php else: ?>
                <p>No details found for the specified bus.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>