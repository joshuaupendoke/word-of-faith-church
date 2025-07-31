<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Church Management System</title>
  <style>
    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #2c3e50;
      padding: 15px;
      color: white;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo-container {
      display: flex;
      align-items: center;
    }

    .logo {
      height: 50px;
      margin-right: 10px;
    }

    .logo-text {
      font-size: 1.2em;
      font-weight: bold;
    }

    nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
    }

    nav ul li {
      margin-right: 15px;
    }

    nav ul li a {
      text-decoration: none;
      color: white;
      font-size: 1em;
      transition: color 0.3s;
    }

    nav ul li a:hover {
      color: #f1c40f;
    }

    main {
      text-align: center;
      padding: 20px;
    }

    .dashboard-overview {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .card h2 {
      margin-bottom: 10px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      background: #2980b9;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 10px;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #1f618d;
    }

    footer {
      background-color: #2c3e50;
      color: white;
      text-align: center;
      padding: 10px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <div class="logo-container">
        <a href="admin_dashboard.php">
          <img src="word_of_faith_logo.png" alt="Church Logo" class="logo">
        </a>
        <span class="logo-text">WORD OF FAITH CHURCH INTERNATIONAL</span>
      </div>
      <ul>
        <li><a href="admin_dashboard.php">Dashboard</a></li>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="donation_report.php">Donation Reports</a></li>
        <li><a href="manage_departments.php">Manage Departments</a></li>
        <li><a href="create_volunteer_task.php">Create Volunteer Task</a></li>
        <li><a href="view_volunteers.php">View Volunteers</a></li>
        <li><a href="create_event.php">Create Event</a></li>
        <li><a href="upload_sermon.php">Upload Sermon</a></li>
        <li><a href="view_prayers.php">View Prayer Requests</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Welcome, Admin <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
    <section class="dashboard-overview">
      <div class="card">
        <h2>Manage Users</h2>
        <p>View and manage all user accounts.</p>
        <a href="manage_users.php" class="btn">Go</a>
      </div>
      <div class="card">
        <h2>Donation Reports</h2>
        <p>Review donation records and financial summaries.</p>
        <a href="donation_report.php" class="btn">View Reports</a>
      </div>
      <div class="card">
        <h2>Manage Departments</h2>
        <p>Oversee departments and assign department heads.</p>
        <a href="manage_departments.php" class="btn">Manage</a>
      </div>
      <div class="card">
        <h2>Volunteer Tasks</h2>
        <p>Create and monitor volunteer tasks.</p>
        <a href="create_volunteer_task.php" class="btn">Create Task</a>
      </div>
      <div class="card">
        <h2>Create Event</h2>
        <p>Schedule and manage church events.</p>
        <a href="create_event.php" class="btn">Create Event</a>
      </div>
      <div class="card">
        <h2>Upload Sermon</h2>
        <p>Upload sermons for church members.</p>
        <a href="upload_sermon.php" class="btn">Upload</a>
      </div>
      <div class="card">
        <h2>Prayer Requests</h2>
        <p>Review and respond to submitted prayer requests.</p>
        <a href="view_prayers.php" class="btn">View Requests</a>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> Word of Faith Church International. All Rights Reserved.</p>
  </footer>
</body>
</html>
