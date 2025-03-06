<?php
include 'db_connection.php'; // Ensure this file correctly sets up the database connection

// Query to fetch driver data
$driversQuery = "SELECT driver_id, name, email, rfid_tag FROM drivers ORDER BY name ASC";
$driversResult = $conn->query($driversQuery);

// Check for query errors
if (!$driversResult) {
    die("SQL error: " . $conn->error);
}

// Fetch data into an array
$driversData = [];
if ($driversResult->num_rows > 0) {
    while ($row = $driversResult->fetch_assoc()) {
        $driversData[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver List</title>
    <link rel="stylesheet" href="drivers.css">
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
    <a href="Shiftlogs.php" class="active">Shift Logs</a>
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
            <h1>Driver List</h1>
        </div>
        <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search by Name, Email, or RFID Tag...">
        <button onclick="searchDrivers()">Search</button>
        <button id="addDriverButton" onclick="addNewDriver()">Add New Driver</button>
        <button id="exportButton" onclick="exportDriverList()">Export Driver List</button>
    </div>
        <div class="drivers-table">
            <table id="driversTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>RFID Tag</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($driversData)): ?>
                    <?php foreach ($driversData as $driver): ?>
                        <tr onclick="viewDriverDetails(<?php echo htmlspecialchars($driver['driver_id']); ?>)">
                            <td><?php echo htmlspecialchars($driver['name']); ?></td>
                            <td><?php echo htmlspecialchars($driver['email']); ?></td>
                            <td><?php echo htmlspecialchars($driver['rfid_tag']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No drivers found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="drivers.js"></script>
</body>
</html>