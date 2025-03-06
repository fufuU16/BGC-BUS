<?php
include 'db_connection.php';

$feedbackMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $feedbackMessage = "Feedback submitted successfully!";
    } else {
        $feedbackMessage = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - BGC Landing Page</title>
    <link rel="stylesheet" href="ContactUs.css">
</head>
<body>
    <header>
     
        <nav>
        <a href="Passenger.php">Home</a>
            <a href="Routes.php">Routes</a>
            <a href="AboutUs.php">About Us</a>
            <a href="ContactUs.php" class="active">Contact Us</a>
        </nav>
    </header>
    
    <main>
        <h1>Contact Us</h1>
        <?php if ($feedbackMessage): ?>
        <div class="feedback-message"><?php echo $feedbackMessage; ?></div>
    <?php endif; ?>
        <section class="contact-info">
            <h2>Get in Touch</h2>
            <p>If you have any questions or need further information, feel free to contact us:</p>
            <ul>
                <li><strong>Email:</strong> support@bgclandingpage.com</li>
                <li><strong>Phone:</strong> +1 (234) 567-890</li>
                <li><strong>Address:</strong> 123 BGC Street, City, Country</li>
            </ul>
        </section>
        
        <section class="feedback-form">
            <h2>Feedback</h2>
            <p>We value your feedback. Please let us know how we can improve our services:</p>
            <form action="#" method="post">
            <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="OPTIONAL">
</div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Feedback:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit">Submit Feedback</button>
            </form>
        </section>
    </main>
    
   
</body>
</html>