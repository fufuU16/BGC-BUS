<?php
// Include database connection
include 'db_connection.php';

date_default_timezone_set('Asia/Manila');
// Query to fetch data from the database, including overall totals
$query = "
    SELECT date, route, SUM(passengers) as total_passengers 
    FROM passenger_data 
    GROUP BY date, route
    UNION ALL
    SELECT date, 'Overall' as route, SUM(passengers) as total_passengers 
    FROM passenger_data 
    GROUP BY date
";

// Query to fetch upcoming maintenance alerts
$maintenanceAlertQuery = "
    SELECT bus_id, next_scheduled_maintenance, last_maintenance
    FROM bus_details
    WHERE next_scheduled_maintenance <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) 
    OR last_maintenance <= DATE_SUB(CURDATE(), INTERVAL 180 DAY)
    ORDER BY next_scheduled_maintenance ASC
";

// Execute passenger data query
$result = $conn->query($query);
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Execute the maintenance alerts query
$maintenanceAlerts = [];
$maintenanceResult = $conn->query($maintenanceAlertQuery);
if ($maintenanceResult->num_rows > 0) {
    while ($row = $maintenanceResult->fetch_assoc()) {
        $maintenanceAlerts[] = $row;
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="Dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Add cursor pointer for clickable elements */
        .chartjs-render-monitor {
            cursor: pointer;
        }
    </style>
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
            <a href="Dashboard.php" class="active">Dashboard</a>
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
            <h1>Fleet Management</h1>
        </div>
        <div class="card-container">
            <div class="card-content">
                <div class="card-icon">
                    <img src="../image/bus.png" alt="Icon" />
                </div>
                <div class="card-text">
                    <div class="card-text-upper">41</div>
                    <div class="card-text-lower">Buses</div>
                </div>
            </div>
            <div class="card-content">
                <div class="card-icon">
                    <img src="../image/passenger.png" alt="Icon" />
                </div>
                <div class="card-text">
                    <div class="card-text-upper">423</div>
                    <div class="card-text-lower">Passengers</div>
                </div>
            </div>
            <div class="card-content">
                <div class="card-icon">
                    <img src="../image/busstop.png" alt="Icon" />
                </div>
                <div class="card-text">
                    <div class="card-text-upper">40</div>
                    <div class="card-text-lower">Bus stops</div>
                </div>
            </div>
            <div class="card-content">
                <div class="card-icon">
                    <img src="../image/calendar.png" alt="Icon" />
                </div>
                <div class="card-text">
                    <div class="card-text-upper">50</div>
                    <div class="card-text-lower">Schedules</div>
                </div>
            </div>
        </div>
        <div class="devider">
            <div class="Title1">
                <h1><?php echo date('l, F j, Y \a\t g:i A'); ?></h1>
            </div>
        </div>
        <div class="special-card-container">
            <div class="card card-left-top">
                <div class="card-text">
                    <div class="card-text-upper">16</div>
                    <div class="card-text-lower">Bus Deployed</div>
                </div>
            </div>
            <div class="card card-left-middle">
                <div class="card-text">
                    <div class="card-text-upper">PMS</div>
                    <div class="card-text-lower">
                        <p>Upcoming Maintenance</p>
                        <ul>
                            <?php if (!empty($maintenanceAlerts)): ?>
                                <?php foreach ($maintenanceAlerts as $alert): ?>
                                    <li>
                                        Bus <?php echo htmlspecialchars($alert['bus_id']); ?>: 
                                        Next maintenance on <?php echo htmlspecialchars($alert['next_scheduled_maintenance']); ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>No upcoming maintenance scheduled.</li>
                            <?php endif; ?>
                        </ul>
                        <p>Alerts for Maintenance Due</p>
                        <ul>
                            <?php if (!empty($maintenanceAlerts)): ?>
                                <?php foreach ($maintenanceAlerts as $alert): ?>
                                    <?php
                                    $lastMaintenanceDate = new DateTime($alert['last_maintenance']);
                                    $currentDate = new DateTime();
                                    $interval = $currentDate->diff($lastMaintenanceDate)->days;
                                    ?>
                                    <?php if ($interval >= 180): ?>
                                        <li>
                                            Bus <?php echo htmlspecialchars($alert['bus_id']); ?>: 
                                            Maintenance due (Last maintenance: <?php echo htmlspecialchars($alert['last_maintenance']); ?>)
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>No overdue maintenance alerts.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card card-middle">
                <h2>Passenger Counts</h2>
                <canvas id="passengerChart"></canvas>
            </div>
            <div class="card card-right" style="border: 3px solid #F28C28;">
                <div class="card-text">
                    <h2>Shift Logs</h2>
                    <ul class="shift-logs">
                        <li>
                            <img src="../image/karen.jpg" alt="Profile Icon" class="profile-icon">
                            Juan Dela Cruz Bus #: 01 Shift: 6:00 am - 11:00 am Bus Plate #: NV 9989 Route: Central
                        </li>
                        <li>
                            <img src="../image/judy.png" alt="Profile Icon" class="profile-icon">
                            Juan Dela Cruz Bus #: 01 Shift: 6:00 am - 11:00 am Bus Plate #: NV 9989 Route: Central
                        </li>
                        <li>
                            <img src="../image/Josh.jpg" alt="Profile Icon" class="profile-icon">
                            Juan Dela Cruz Bus #: 01 Shift: 6:00 am - 11:00 am Bus Plate #: NV 9989 Route: Central
                        </li>
                        <li>
                            <img src="../image/karen.jpg" alt="Profile Icon" class="profile-icon">
                            Juan Dela Cruz Bus #: 01 Shift: 6:00 am - 11:00 am Bus Plate #: NV 9989 Route: Central
                        </li>
                        <li>
                            <img src="../image/judy.png" alt="Profile Icon" class="profile-icon">
                            Juan Dela Cruz Bus #: 01 Shift: 6:00 am - 11:00 am Bus Plate #: NV 9989 Route: Central
                        </li>
                        <li>
                            <img src="../image/Josh.jpg" alt="Profile Icon" class="profile-icon">
                            Juan Dela Cruz Bus #: 01 Shift: 6:00 am - 11:00 am Bus Plate #: NV 9989 Route: Central
                        </li>
                        <!-- More list items -->
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script>
  document.addEventListener('DOMContentLoaded', function () {
    fetch('fetch_passenger_data.php') // Fetch data from the new PHP file
        .then(response => response.json())
        .then(data => {
            let labels = [];
            let datasets = {};

            let routeColors = {
                "Overall": "#00796B", // Overall total color
                "ARCA South Route": "#E65100", // Unique color for ARCA South Route
                "Central Route": "#4682B4", // Unique color for Central Route
                "East Route": "#2E7D32", // Unique color for East Route
                "North Route": "#C62828", // Unique color for North Route
                "Weekend Route": "#FFC107", // Unique color for Weekend Route
                "West Route": "#673AB7" // Unique color for West Route
            };

            // Sort routes alphabetically, keeping "Overall" first
            let sortedRoutes = Object.keys(routeColors).sort((a, b) => {
                if (a === "Overall") return -1;
                if (b === "Overall") return 1;
                return a.localeCompare(b);
            });

            data.forEach(item => {
                if (!labels.includes(item.date)) {
                    labels.push(item.date);
                }
                if (!datasets[item.route]) {
                    datasets[item.route] = {
                        label: item.route,
                        data: [],
                        backgroundColor: routeColors[item.route] || '#000000',
                        borderColor: routeColors[item.route] || '#000000',
                        borderWidth: 1
                    };
                }
                datasets[item.route].data.push(item.total_passengers);
            });

            let ctx = document.getElementById('passengerChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: sortedRoutes.map(route => datasets[route])
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { stacked: true, ticks: { autoSkip: false } },
                        y: { beginAtZero: true, min: 0, ticks: { stepSize: 2000 } }
                    },
                    hover: {
                        onHover: function(event, chartElement) {
                            event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
                        }
                    },
                    onClick: (e, elements) => {
                        if (elements.length > 0) {
                            const chart = elements[0]._chart;
                            const datasetIndex = elements[0]._datasetIndex;
                            const route = chart.data.datasets[datasetIndex].label;
                            alert(`You clicked on the ${route} route.`);
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching passenger data:', error));
});
    </script>

</body>
</html>