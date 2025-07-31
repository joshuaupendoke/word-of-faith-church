<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the logged-in user is a department head
$dept_check = mysqli_query($conn, "SELECT * FROM departments WHERE head_id = $user_id");
$department = mysqli_fetch_assoc($dept_check);

if (!$department) {
    echo "You are not assigned as a Department Head.";
    exit();
}

// Fetch department members
$members = mysqli_query($conn, "SELECT users.name FROM users 
                                INNER JOIN member_departments ON users.id = member_departments.member_id 
                                WHERE member_departments.department_id = " . $department['id']);
?>

<h2>Department Head Dashboard</h2>
<p>You are managing the <strong><?php echo $department['name']; ?></strong> department.</p>

<h3>Members in Your Department:</h3>
<ul>
    <?php while ($row = mysqli_fetch_assoc($members)) { ?>
        <li><?php echo $row['name']; ?></li>
    <?php } ?>
</ul>
