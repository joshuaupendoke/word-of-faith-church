<?php
session_start();
include "config.php"; // Your database connection file

// Only allow Admins or Pastors to create tasks
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Pastor')) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $task_date = $_POST['task_date'];
    $created_by = $_SESSION['user_id'];
    
    $query = "INSERT INTO volunteer_tasks (title, description, task_date, created_by) VALUES ('$title', '$description', '$task_date', $created_by)";
    if(mysqli_query($conn, $query)){
        echo "Volunteer task created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Volunteer Task</title>
</head>
<body>
    <h2>Create Volunteer Task</h2>
    <form method="POST" action="create_volunteer_task.php">
        <input type="text" name="title" placeholder="Task Title" required><br>
        <textarea name="description" placeholder="Task Description" required></textarea><br>
        <input type="date" name="task_date" required><br>
        <button type="submit">Create Task</button>
    </form>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
