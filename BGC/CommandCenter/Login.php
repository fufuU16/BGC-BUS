<?php
// Include the database connection script
include 'db_connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password, $role);
        $stmt->fetch();

        // Verify password and check role
        if (password_verify($password, $hashed_password) && in_array($role, ['superAdmin', 'MidAdmin', 'Admin'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user_id; // Add this line to set the user_id
        
            // Log the login event
            $action = "User logged in";
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
            $logStmt = $conn->prepare("INSERT INTO activity_logs (user_id, username, action, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
            $logStmt->bind_param("issss", $user_id, $username, $action, $ip_address, $user_agent);
            $logStmt->execute();
            $logStmt->close();
        
            echo "Login successful. Welcome, $role!";
            header("Location: Dashboard.php");
            exit();
        } else {
            echo "Invalid credentials or insufficient permissions.";
        }
    } else {
        echo "Invalid credentials.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BGC Bus Login</title>
    <link rel="stylesheet" href="Login.css">
</head>
<body>
   
    
    <main>
       
        <div class="login-container">
            <form method="POST" action="">
                <div class="bgclogo">
                    <img src="../image/bgc.PNG" alt="Bgc Logo">
                </div>
              
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                
                <button type="submit">Login</button>
            </form>
        </div>

      
    </main>
</body>
</html>