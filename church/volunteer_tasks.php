<?php
session_start();
include "config.php";

// Only Members can sign up for volunteer tasks
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Member') {
    header("Location: login.php");
    exit();
}

// Process sign-up request
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $task_id = $_POST['task_id'];
    $member_id = $_SESSION['user_id'];
    
    // Check if already signed up for this task
    $check = mysqli_query($conn, "SELECT * FROM volunteer_signups WHERE task_id = $task_id AND member_id = $member_id");
    if(mysqli_num_rows($check) > 0){
        echo "You have already signed up for this task.";
    } else {
        $query = "INSERT INTO volunteer_signups (task_id, member_id) VALUES ($task_id, $member_id)";
        if(mysqli_query($conn, $query)){
            echo "You have successfully signed up for this task!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Fetch all volunteer tasks
$tasks = mysqli_query($conn, "SELECT * FROM volunteer_tasks ORDER BY task_date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Tasks</title>
</head>
<body>
    <h2>Volunteer Tasks</h2>
    <?php while($task = mysqli_fetch_assoc($tasks)) { ?>
        <div style="border: 1px solid #ccc; margin: 10px; padding: 10px;">
            <h3><?php echo $task['title']; ?></h3>
            <p><?php echo $task['description']; ?></p>
            <p><strong>Date:</strong> <?php echo $task['task_date']; ?></p>
            <form method="POST" action="volunteer_tasks.php">
                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                <button type="submit">Sign Up</button>
            </form>
        </div>
    <?php } ?>
    <a href="member_dashboard.php">Back to Dashboard</a>
</body>
</html>
