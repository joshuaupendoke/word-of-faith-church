<?php
session_start();
include "config.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to submit a prayer request.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $request = mysqli_real_escape_string($conn, $_POST['request']);

    $query = "INSERT INTO prayer_requests (user_id, request) VALUES ('$user_id', '$request')";
    if (mysqli_query($conn, $query)) {
        echo "Prayer request submitted successfully!";
    } else {
        echo "Error submitting request.";
    }
}
?>

<form method="POST">
    <textarea name="request" placeholder="Enter your prayer request..." required></textarea>
    <button type="submit">Submit Prayer Request</button>
</form>
