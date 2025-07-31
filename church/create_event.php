<?php
session_start();
include "config.php";

// Check if user is an Admin or Pastor
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Pastor')) {
    echo "Access Denied!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $event_date = $_POST['event_date'];
    $created_by = $_SESSION['user_id'];

    $query = "INSERT INTO events (title, description, event_date, created_by) VALUES ('$title', '$description', '$event_date', $created_by)";
    mysqli_query($conn, $query);

    // Notify members
    $message = "New Event: $title on $event_date";
    mysqli_query($conn, "INSERT INTO notifications (user_id, message) SELECT id, '$message' FROM users WHERE role = 'Member'");

    echo "Event created successfully!";
}
?>

<form method="POST">
    <input type="text" name="title" placeholder="Event Title" required>
    <textarea name="description" placeholder="Event Description" required></textarea>
    <input type="date" name="event_date" required>
    <button type="submit">Create Event</button>
</form>
