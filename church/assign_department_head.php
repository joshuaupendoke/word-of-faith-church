<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}
include "config.php";

// Fetch all departments
$departments = mysqli_query($conn, "SELECT * FROM departments");

// Handle assignment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_id = $_POST['department_id'];
    $head_id = $_POST['head_id'];

    $query = "UPDATE departments SET head_id = $head_id WHERE id = $department_id";
    mysqli_query($conn, $query);
    echo "Department Head assigned successfully!";
}

// Fetch members eligible to be department heads
$members = mysqli_query($conn, "SELECT * FROM users WHERE role = 'Member'");
?>

<h2>Assign Department Head</h2>
<form method="POST">
    <label>Select Department:</label>
    <select name="department_id">
        <?php while ($row = mysqli_fetch_assoc($departments)) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select>

    <label>Select Member as Head:</label>
    <select name="head_id">
        <?php while ($row = mysqli_fetch_assoc($members)) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select>

    <button type="submit">Assign</button>
</form>
