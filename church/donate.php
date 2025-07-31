<?php
session_start();
include "config.php"; // Ensure you have a valid database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    
    // Insert donation record into the database
    $sql = "INSERT INTO donations (user_id, amount, payment_method) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ids", $user_id, $amount, $payment_method);
    
    if ($stmt->execute()) {
        echo "Thank you for your donation!";
    } else {
        echo "Error processing donation. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - Church Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Make a Donation</h2>
    <form action="donate.php" method="POST">
        <label for="amount">Donation Amount:</label>
        <input type="number" step="0.01" name="amount" required>
        <br>
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" required>
            <option value="MPesa">MPesa</option>
            <option value="Credit Card">Credit Card</option>
            <option value="Cash">Cash</option>
        </select>
        <br>
        <button type="submit">Donate Now</button>
    </form>
    <br>
    <a href="member_dashboard.php">Back to Dashboard</a>
</body>
</html>
