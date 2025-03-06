<?php
include 'db_connection.php'; // Ensure this file correctly sets up the database connection

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $rfid_tag = trim($_POST['rfid_tag']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $driver_number = trim($_POST['driver_number']);
    $bus_routes = trim($_POST['bus_routes']);
    $image = $_FILES['driver_image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    // Server-side validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } elseif (!preg_match("/^[A-Za-z\s]+$/", $name)) {
        $message = "Name must not contain numbers or special characters.";
    } elseif (!move_uploaded_file($_FILES['driver_image']['tmp_name'], $target_file)) {
        $message = "Failed to upload image.";
    } else {
        // Check if email already exists
        $checkEmailStmt = $conn->prepare("SELECT email FROM drivers WHERE email = ?");
        $checkEmailStmt->bind_param("s", $email);
        $checkEmailStmt->execute();
        $checkEmailStmt->store_result();

        if ($checkEmailStmt->num_rows > 0) {
            $message = "Email already exists. Please use a different email.";
        } else {
            // Prepare and execute the SQL statement
            $stmt = $conn->prepare("INSERT INTO drivers (name, email, rfid_tag, password, driver_number, bus_routes, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $name, $email, $rfid_tag, $password, $driver_number, $bus_routes, $target_file);

            if ($stmt->execute()) {
                $message = "New driver added successfully!";
            } else {
                $message = "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $checkEmailStmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Driver</title>
    <link rel="stylesheet" href="addDriver.css">
</head>
<body>
<header>
   
    <?php session_start();if (!isset($_SESSION['username'])) {
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
        <h1>Add New Driver</h1>
    </div>
    <div class="card-container">
    <div class="card">
        <form action="addDriver.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-content">
            <div class="form-left">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="rfid_tag">RFID Tag:</label>
    <input type="text" id="rfid_tag" name="rfid_tag" required>
    
   
    <label for="driver_number">Plate Number:</label>
    <input type="text" id="driver_number" name="driver_number" required>
    
    <label for="bus_routes">Bus Routes:</label>
    <input type="text" id="bus_routes" name="bus_routes" required>
</div>
                <div class="form-right">
                <label for="driver_image">Driver Image:</label>
    <input type="file" id="driver_image" name="driver_image" accept="image/*" required onchange="previewImage(event)"><br><br>
    <div class="image-container">
        <img id="image_preview" src="#" alt="Image Preview" style="display: none;">
    </div>
    <button type="submit">Add Driver</button>
    <button class="back-to-shiftlogs" onclick="goToShiftLogs()">Back to Shift Logs</button><br>

</div>
            </div>
           
        </form>

        <br> 
    </div>
</div>
</main>
<script>
function previewImage(event) {
    const imagePreview = document.getElementById('image_preview');
    imagePreview.src = URL.createObjectURL(event.target.files[0]);
    imagePreview.style.display = 'block';
}

function togglePassword() {
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(input => {
        const toggleButton = input.nextElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            toggleButton.textContent = 'Hide';
        } else {
            input.type = 'password';
            toggleButton.textContent = 'Show';
        }
    });
}

function validateForm() {
    const name = document.getElementById('name').value;
    const namePattern = /^[A-Za-z\s]+$/; // Only letters and spaces
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    if (!namePattern.test(name)) {
        alert('Name must not contain numbers or special characters.');
        return false;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true;
}

function goToShiftLogs() {
    window.location.href = 'drivers.php';
}
</script>
</body>
</html>