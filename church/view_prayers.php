<?php
session_start();
include "config.php";

// Only Admins and Pastors can access
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Pastor')) {
    echo "Access Denied!";
    exit();
}

// Fetch prayer requests
$requests = mysqli_query($conn, "SELECT prayer_requests.*, users.username FROM prayer_requests JOIN users ON prayer_requests.user_id = users.id ORDER BY submitted_at DESC");

if (isset($_POST['mark_prayed'])) {
    $id = $_POST['request_id'];
    mysqli_query($conn, "UPDATE prayer_requests SET status='Prayed For' WHERE id=$id");
    echo "Marked as Prayed For!";
    header("Refresh:0");
}
?>

<h2>Prayer Requests</h2>

<?php while ($req = mysqli_fetch_assoc($requests)) { ?>
    <div>
        <p><strong><?php echo $req['username']; ?></strong> - <?php echo $req['request']; ?></p>
        <p>Status: <?php echo $req['status']; ?></p>
        <?php if ($req['status'] == 'Pending') { ?>
            <form method="POST">
                <input type="hidden" name="request_id" value="<?php echo $req['id']; ?>">
                <button type="submit" name="mark_prayed">Mark as Prayed For</button>
            </form>
        <?php } ?>
    </div>
<?php } ?>
