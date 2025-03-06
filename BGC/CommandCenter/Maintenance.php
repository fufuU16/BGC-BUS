<?php
include 'db_connection.php'; // Ensure this file correctly sets up the database connection

// Query to fetch maintenance data with all possible maintenance types
$maintenanceQuery = "
    SELECT bd.bus_id, bd.plate_number, bd.next_scheduled_maintenance, bd.current_status AS status, 
           md.TypeofMaintenance, md.odometer_at_maintenance, bd.TotalOdometer
    FROM bus_details bd
    LEFT JOIN maintenance_data md ON bd.bus_id = md.bus_id
    ORDER BY bd.next_scheduled_maintenance DESC
";

$maintenanceResult = $conn->query($maintenanceQuery);

// Check for query errors
if (!$maintenanceResult) {
    die("SQL error: " . $conn->error);
}

// Fetch data into an array
$maintenanceData = [];
if ($maintenanceResult->num_rows > 0) {
    while ($row = $maintenanceResult->fetch_assoc()) {
        $maintenanceData[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <link rel="stylesheet" href="Maintenance.css">
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
            <a href="Maintenance.php" class="active">Maintenance</a>
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
            <h1>Maintenance</h1>
        </div>
        
        <!-- Search bar and export button -->
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by Bus ID, Plate Number, or Status..." onkeyup="searchLogs()">
            <button onclick="exportReport()">Export Report</button>
        </div>
        
        <div class="logs-table">
            <table id="busTable">
                <thead>
                    <tr>
                        <th>Bus ID</th>
                        <th>Plate Number</th>
                        <th>Next Scheduled Maintenance</th>
                        <th>Last Change/Check</th>
                        <th>Maintenance Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($maintenanceData)): ?>
                    <?php foreach ($maintenanceData as $bus): ?>
                        <?php
                        $maintenanceIntervals = [
                            'Oil Change' => 10000,
                            'Tire Replacement' => 40000,
                            'Brake Replacement' => 30000
                        ];

                        $maintenanceNeeded = false;
                        if (isset($maintenanceIntervals[$bus['TypeofMaintenance']])) {
                            $nextMaintenanceOdometer = $bus['odometer_at_maintenance'] + $maintenanceIntervals[$bus['TypeofMaintenance']];
                            $maintenanceNeeded = $bus['TotalOdometer'] >= $nextMaintenanceOdometer;
                        }
                        ?>
                        <tr data-bus-id="<?php echo htmlspecialchars($bus['bus_id']); ?>">
                            <td><?php echo htmlspecialchars($bus['bus_id']); ?></td>
                            <td><?php echo htmlspecialchars($bus['plate_number']); ?></td>
                            <td><?php echo htmlspecialchars($bus['next_scheduled_maintenance']); ?></td>
                            <td><?php echo htmlspecialchars($bus['odometer_at_maintenance']); ?></td>
                            <td><?php echo htmlspecialchars($bus['TypeofMaintenance']); ?></td>
                            <td><?php echo $maintenanceNeeded ? 'Required' : 'Done'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No maintenance records found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function searchLogs() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let table = document.getElementById("busTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let row = rows[i];
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            }
        }

        function exportReport() {
            let table = document.getElementById("busTable");
            let rows = table.getElementsByTagName("tr");
            let csvContent = "Bus ID,Plate Number,Next Scheduled Maintenance,Last Change/Check,Maintenance Type,Status\n";

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                if (cells.length > 0) {
                    let rowData = [];
                    for (let cell of cells) {
                        rowData.push(cell.innerText);
                    }
                    csvContent += rowData.join(",") + "\n";
                }
            }

            let blob = new Blob([csvContent], { type: "text/csv" });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "Maintenance_Report.csv";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('#busTable tbody tr');

            rows.forEach(row => {
                row.addEventListener('click', function() {
                    const busId = this.getAttribute('data-bus-id');
                    if (busId && busId.trim() !== "") {
                        window.location.href = `busDetails.php?bus_id=${encodeURIComponent(busId)}`;
                    }
                });
            });
        });
    </script>
</body>
</html>