<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Church Management System</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <header>
    <nav>
      <div class="logo-container">
        <a href="dashboard.php">
          <img src="word_of_faith_logo.png" alt="Church Logo" class="logo">
        </a>
        <span class="logo-text">WORD OF FAITH CHURCH INTERNATIONAL</span>
      </div>
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="view_notifications.php">Notifications</a></li>
        <?php if ($_SESSION['role'] == 'Admin'): ?>
          <li><a href="manage_users.php">Manage Users</a></li>
          <li><a href="donation_report.php">Donation Reports</a></li>
          <li><a href="manage_departments.php">Manage Departments</a></li>
          <li><a href="create_volunteer_task.php">Create Volunteer Task</a></li>
          <li><a href="view_volunteers.php">View Volunteer Signups</a></li>
          <li><a href="create_event.php">Create Event</a></li>
          <li><a href="upload_sermon.php">Upload Sermon</a></li>
          <li><a href="view_prayers.php">View Prayer Requests</a></li>
        <?php elseif ($_SESSION['role'] == 'Pastor'): ?>
          <li><a href="view_members.php">View Members</a></li>
          <li><a href="create_event.php">Create Event</a></li>
          <li><a href="upload_sermon.php">Upload Sermon</a></li>
          <li><a href="view_prayers.php">Prayer Requests</a></li>
        <?php elseif ($_SESSION['role'] == 'Member'): ?>
          <li><a href="view_events.php">View Events</a></li>
          <li><a href="volunteer_tasks.php">Volunteer Tasks</a></li>
          <li><a href="submit_prayer.php">Submit Prayer Request</a></li>
          <li><a href="donate.php">Donate</a></li>
          <li><a href="join_department.php">Join Department</a></li>
        <?php endif; ?>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
    <?php if ($_SESSION['role'] == 'Admin'): ?>
      <p>This is the Admin Dashboard. Here you can manage users, view donation reports, oversee departments, create volunteer tasks and events, upload sermons, and review prayer requests.</p>
    <?php elseif ($_SESSION['role'] == 'Pastor'): ?>
      <p>This is the Pastor Dashboard. Here you can manage sermons, view prayer requests, and interact with church members.</p>
    <?php elseif ($_SESSION['role'] == 'Member'): ?>
      <p>This is the Member Dashboard. Here you can view upcoming events, sign up for volunteer tasks, submit prayer requests, donate, and join departments.</p>
    <?php endif; ?>
    <!-- Additional dynamic dashboard content can be added here -->
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> Word of Faith Church International. All Rights Reserved.</p>
  </footer>
</body>
</html>
