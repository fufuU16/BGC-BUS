<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bgc_database";

// Create database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get RFID from POST data
    $rfid = $_POST['rfid'];

    // Check if RFID is provided
    if (!empty($rfid)) {
        // Query the database to find the driver with the given RFID tag
        $stmt = $conn->prepare("SELECT * FROM driver WHERE rfid_tag = ?");
        $stmt->bind_param("s", $rfid);
        $stmt->execute();
        $result = $stmt->get_result();

        // If a match is found
        if ($result->num_rows > 0) {
            $driver = $result->fetch_assoc();

            // Log attendance into the database
            $logStmt = $conn->prepare("INSERT INTO shift_log (driver_id,driver_name, timestamp) VALUES (?,?, NOW())");
            $logStmt->bind_param("is", $driver['id'],$drive['name']);
            if ($logStmt->execute()) {
                echo "Attendance logged for " . $driver['name'];
            } else {
                echo "Error logging attendance: " . $conn->error;
            }
            $logStmt->close();
        } else {
            echo "Invalid RFID";
        }
        $stmt->close();
    } else {
        echo "No RFID provided";
    }
} else {
    echo "Invalid request method";
}

// Close the database connection
$conn->close(); 
?>
