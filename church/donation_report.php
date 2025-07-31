<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$donations = mysqli_query($conn, "SELECT donations.*, users.name 
                                  FROM donations 
                                  JOIN users ON donations.user_id = users.id 
                                  ORDER BY donation_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Report - Church Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #2c3e50; color: white; }
    </style>
</head>
<body>
    <h2>Donation Report</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Donation Date</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($donations)) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['payment_method']; ?></td>
            <td><?php echo $row['donation_date']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
