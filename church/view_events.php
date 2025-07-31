<?php
session_start();
include "config.php";

// Fetch upcoming events
$events = mysqli_query($conn, "SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC");
?>

<h2>Upcoming Church Events</h2>

<?php while ($event = mysqli_fetch_assoc($events)) { ?>
    <div>
        <h3><?php echo $event['title']; ?></h3>
        <p><?php echo $event['description']; ?></p>
        <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
    </div>
<?php } ?>
