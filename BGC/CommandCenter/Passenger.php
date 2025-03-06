<?php
// Include the database connection
include 'db_connection.php'; // Ensure this file exists and is correct

// Initialize search term
$searchTerm = isset($_GET['route_search']) ? $_GET['route_search'] : '';

// Query to fetch data for each route with bus numbers and their passenger counts
$routeQuery = "
    SELECT route, bus_id, current_passengers, 
           SUM(current_passengers) OVER (PARTITION BY route) as overall_count
    FROM bus_passenger_data
    WHERE date = CURDATE()
";

if ($searchTerm) {
    $routeQuery .= " AND route LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
}

$routeQuery .= " ORDER BY route, bus_id";

// Execute the query
$routeResult = $conn->query($routeQuery);

// Check for query errors
if (!$routeResult) {
    die("SQL error: " . $conn->error);
}

// Process the results into a structured array
$routeData = [];
if ($routeResult->num_rows > 0) {
    while ($row = $routeResult->fetch_assoc()) {
        $routeData[$row['route']][] = $row;
    }
} else {
    $noDataMessage = "No data found for the current date.";
}

// Query to fetch historical data for the past 7 days
$historyQuery = "
    SELECT date, route, SUM(passengers) as total_passengers 
    FROM passenger_data 
    GROUP BY date, route
    UNION ALL
    SELECT date, 'Overall' as route, SUM(passengers) as total_passengers 
    FROM passenger_data 
    GROUP BY date
";

// Execute the historical query
$historyResult = $conn->query($historyQuery);

// Check for query errors
if (!$historyResult) {
    die("SQL error: " . $conn->error);
}

// Process the historical results into a structured array
$historyData = [];
if ($historyResult->num_rows > 0) {
    while ($row = $historyResult->fetch_assoc()) {
        $historyData[] = $row;
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
    <title>Passenger Details</title>
    <link rel="stylesheet" href="passenger.css"> <!-- Ensure this file exists -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <a href="Passenger.php" class="active">Passengers</a>
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
            <h1>Passenger Details</h1>
        </div>
        
        <div id="PassengerDetails">
            <h2>Passenger Counts by Route</h2>
            <form method="GET" action="Passenger.php">
                <input type="text" name="route_search" placeholder="Search by route" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">Search</button>
            </form>
            <?php if (!empty($routeData)): ?>
                <?php foreach ($routeData as $route => $buses): ?>
                    <h3>Route: <?php echo htmlspecialchars($route); ?></h3>
                    <table class="routePassengerCounts">
                        <thead>
                            <tr>
                                <th>Bus Number</th>
                                <th>Passenger Count</th>
                                <th>Overall Count (by Route)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($buses as $data): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($data['bus_id']); ?></td>
                                    <td><?php echo htmlspecialchars($data['current_passengers']); ?></td>
                                    <td><?php echo htmlspecialchars($data['overall_count']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
            <?php elseif (!empty($noDataMessage)): ?>
                <p><?php echo htmlspecialchars($noDataMessage); ?></p>
            <?php endif; ?>
        </div>

        <div id="PassengerHistory">
            <h2>Passenger Counts History (Past 7 Days)</h2>
            <canvas id="historyChart"></canvas>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const historyData = <?php echo json_encode($historyData); ?>;
                    let labels = [];
                    let datasets = {};

                    let routeColors = {
                        "Overall": "#00796B",
                        "ARCA South Route": "#E65100",
                        "Central Route": "#4682B4",
                        "East Route": "#2E7D32",
                        "North Route": "#C62828",
                        "Weekend Route": "#FFC107",
                        "West Route": "#673AB7"
                    };

                    historyData.forEach(item => {
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

                    // Sort the datasets alphabetically, keeping "Overall" first
                    const sortedDatasets = Object.keys(datasets).sort((a, b) => {
                        if (a === "Overall") return -1;
                        if (b === "Overall") return 1;
                        return a.localeCompare(b);
                    }).map(key => datasets[key]);

                    let ctx = document.getElementById('historyChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: sortedDatasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: { stacked: true, ticks: { autoSkip: false } },
                                y: { beginAtZero: true, min: 0, ticks: { stepSize: 2000 } }
                            }
                        }
                    });
                });
            </script>
        </div>
    </main>
</body>
</html>