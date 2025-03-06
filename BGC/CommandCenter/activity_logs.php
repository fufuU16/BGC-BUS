<?php
include 'db_connection.php';
session_start();

// Check if the user is logged in and has the appropriate role to view logs
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['superAdmin', 'MidAdmin', 'Admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch activity logs from the database
$query = "SELECT log_id, user_id, username, action, timestamp, ip_address, user_agent FROM activity_logs ORDER BY timestamp DESC";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>
    <link rel="stylesheet" href="activity_logs.css">
</head>
<body>
    <header>
        <div class="logo">
        <img src="../image/bus.png" alt="Bus Logo">
        </div>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="activity_logs.php">Activity Logs</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="Title">
        <h1>Activity Logs</h1>
    </div>

    <div class="logs-table">
        <table>
            <thead>
                <tr>
                    <th>Log ID</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Action</th>
                    <th>Timestamp</th>
              
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['log_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['action']); ?></td>
                        <td><?php echo htmlspecialchars($row['timestamp']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$result->free();
$conn->close();
?>