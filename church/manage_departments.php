<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}
include "config.php";

// Handle department addition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "INSERT INTO departments (name, description) VALUES ('$name', '$description')";
    mysqli_query($conn, $query);
}

// Fetch all departments
$result = mysqli_query($conn, "SELECT * FROM departments");
?>

<h2>Manage Departments</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Department Name" required>
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Add Department</button>
</form>

<h3>Existing Departments</h3>
<ul>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <li><?php echo $row['name']; ?> - <?php echo $row['description']; ?></li>
    <?php } ?>
</ul>
