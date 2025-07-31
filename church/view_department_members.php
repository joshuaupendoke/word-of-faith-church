<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'Pastor')) {
    header("Location: login.php");
    exit();
}
include "config.php";

$departments = mysqli_query($conn, "SELECT * FROM departments");
?>
if (isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];

    // Fetch the department head
    $dept_info = mysqli_query($conn, "SELECT departments.name, users.name AS head_name 
                                       FROM departments 
                                       LEFT JOIN users ON departments.head_id = users.id 
                                       WHERE departments.id = $department_id");
    $dept = mysqli_fetch_assoc($dept_info);
    
    echo "<h3>Department: " . $dept['name'] . "</h3>";
    echo "<p><strong>Department Head:</strong> " . ($dept['head_name'] ? $dept['head_name'] : "Not Assigned") . "</p>";

    // Fetch department members
    $members = mysqli_query($conn, "SELECT users.name FROM users 
                                    INNER JOIN member_departments ON users.id = member_departments.member_id 
                                    WHERE member_departments.department_id = $department_id");

    echo "<h3>Members in this Department:</h3>";
    while ($row = mysqli_fetch_assoc($members)) {
        echo "<p>" . $row['name'] . "</p>";
    }
}


<h2>View Department Members</h2>
<form method="GET">
    <select name="department_id">
        <?php while ($row = mysqli_fetch_assoc($departments)) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select>
    <button type="submit">View</button>
</form>
$members = mysqli_query($conn, "SELECT users.name FROM users 
                                INNER JOIN member_departments ON users.id = member_departments.member_id 
                                WHERE member_departments.department_id = $department_id
                                AND member_departments.status = 'Approved'");

<?php
if (isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];
    $members = mysqli_query($conn, "SELECT users.name FROM users 
        INNER JOIN member_departments ON users.id = member_departments.member_id 
        WHERE member_departments.department_id = $department_id");

    echo "<h3>Members in this Department:</h3>";
    while ($row = mysqli_fetch_assoc($members)) {
        echo "<p>" . $row['name'] . "</p>";
    }
}
?>
