<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shift Logs</title>
    <link rel="stylesheet" href="Shiftlogs.css">
</head>
<body>
    <header>
        
        <?php session_start(); 
        if (!isset($_SESSION['username'])) {
            // Redirect to login page if not logged in
            header("Location: Login.php");
            exit();
        }?>
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
            <h1>Shift Logs</h1>
        </div>
        
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by Driver, Bus, or Status...">
            <button onclick="searchLogs()">Search</button>
            <button id="exportButton" onclick="exportReport()">Export Report</button>     
            <button id="viewDriverListButton" onclick="viewDriverList()">View Driver List</button>
           </div>
            

        <div class="logs-table">
            <table id="logsTable">
                <thead>
                    <tr>
                        <th>Driver</th>
                        <th>Bus</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Route</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Log entries will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="Shiftlogs.js"></script>
</body>
</html>