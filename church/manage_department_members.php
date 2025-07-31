<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the logged-in user is a department head
$dept_check = mysqli_query($conn, "SELECT * FROM departments WHERE head_id = $user_id");
$department = mysqli_fetch_assoc($dept_check);

if (!$department) {
    echo "You are not a Department Head.";
    exit();
}

// Approve or remove members
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    if (isset($_POST['approve'])) {
        mysqli_query($conn, "UPDATE member_departments SET status='Approved' WHERE member_id=$member_id AND department_id=" . $department['id']);
        $message = "Your request to join the department has been approved.";
    } elseif (isset($_POST['remove'])) {
        mysqli_query($conn, "DELETE FROM member_departments WHERE member_id=$member_id AND department_id=" . $department['id']);
        $message = "You have been removed from the department.";
    }

    // Send notification to the user
    mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($member_id, '$message')");
}

?>
