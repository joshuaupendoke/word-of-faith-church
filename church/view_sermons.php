<?php
session_start();
include "config.php";

// Fetch sermons
$sermons = mysqli_query($conn, "SELECT * FROM sermons ORDER BY uploaded_at DESC");
?>

<h2>Church Sermons</h2>

<?php while ($sermon = mysqli_fetch_assoc($sermons)) { ?>
    <div>
        <h3><?php echo $sermon['title']; ?></h3>
        <p><?php echo $sermon['description']; ?></p>
        <a href="<?php echo $sermon['file_path']; ?>" target="_blank">Download/View Sermon</a>
    </div>
<?php } ?>
