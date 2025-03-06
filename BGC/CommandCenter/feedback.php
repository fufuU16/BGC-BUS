<?php
// Include database connection
include 'db_connection.php';

// Query to fetch all feedback
$query = "SELECT id, name, email, message, submitted_at FROM feedback ORDER BY submitted_at DESC";

// Execute the query
$result = $conn->query($query);
$feedbacks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
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
    <title>Feedback</title>
    <link rel="stylesheet" href="feedback.css">
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
            <a href="Feedback.php" class="active">Feedback</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>
    
    <main>
        <h1>Passenger's Feedback</h1>
        <div class="feedback-container">
            <?php if (!empty($feedbacks)): ?>
                <ul class="feedback-list">
                    <?php foreach ($feedbacks as $feedback): ?>
                        <li class="feedback-item">
                            <h3><?php echo htmlspecialchars($feedback['name']); ?> (<?php echo htmlspecialchars($feedback['email']); ?>)</h3>
                            <p><?php echo nl2br(htmlspecialchars($feedback['message'])); ?></p>
                            <small>Submitted on: <?php echo htmlspecialchars($feedback['submitted_at']); ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No feedback available.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>