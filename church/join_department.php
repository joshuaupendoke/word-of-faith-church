<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$department_id = $_POST['department_id'];

// Check if the user is already in the department
$check = mysqli_query($conn, "SELECT * FROM member_departments WHERE member_id = $user_id AND department_id = $department_id");

if (mysqli_num_rows($check) > 0) {
    echo "You have already requested to join this department.";
} else {
    // Insert pending request
    $query = "INSERT INTO member_departments (member_id, department_id, status) VALUES ($user_id, $department_id, 'Pending')";
    mysqli_query($conn, $query);

    // Get the department head ID
    $head_query = mysqli_query($conn, "SELECT head_id FROM departments WHERE id = $department_id");
    $head = mysqli_fetch_assoc($head_query);
    $head_id = $head['head_id'];

    // Send notification to Department Head
    $message = "New request to join your department.";
    mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($head_id, '$message')");

    echo "Request sent to Department Head for approval.";
}
?>
