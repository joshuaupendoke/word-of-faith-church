<?php
session_start();
include "config.php";

// Only allow Admins and Pastors to view volunteer signups
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Pastor')) {
    header("Location: login.php");
    exit();
}

// Fetch all volunteer tasks
$tasks = mysqli_query($conn, "SELECT * FROM volunteer_tasks ORDER BY task_date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Volunteer Signups</title>
</head>
<body>
    <h2>Volunteer Signups</h2>
    <?php while($task = mysqli_fetch_assoc($tasks)) { ?>
        <div style="border: 1px solid #ccc; margin: 10px; padding: 10px;">
            <h3><?php echo $task['title']; ?> (<?php echo $task['task_date']; ?>)</h3>
            <p><?php echo $task['description']; ?></p>
            <h4>Signups:</h4>
            <?php
                $task_id = $task['id'];
                $signups = mysqli_query($conn, "SELECT users.name FROM volunteer_signups JOIN users ON volunteer_signups.member_id = users.id WHERE volunteer_signups.task_id = $task_id");
                if(mysqli_num_rows($signups) > 0) {
                    echo "<ul>";
                    while($signup = mysqli_fetch_assoc($signups)){
                        echo "<li>" . $signup['name'] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No signups yet.</p>";
                }
            ?>
        </div>
    <?php } ?>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
