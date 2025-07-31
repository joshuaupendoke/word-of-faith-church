<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Dashboard - Church Management System</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
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
      flex-wrap: wrap;
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
      display: flex;
      flex-wrap: wrap;
    }

    nav ul li {
      margin-right: 15px;
    }

    nav ul li a {
      text-decoration: none;
      color: white;
      font-size: 1em;
      padding: 8px 12px;
      border-radius: 5px;
      transition: background 0.3s, color 0.3s;
    }

    nav ul li a:hover {
      background: #f1c40f;
      color: #2c3e50;
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
      padding: 20px;
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card h2 {
      color: #2c3e50;
      margin-bottom: 10px;
    }

    .card p {
      color: #555;
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

    /* Responsive Design */
    @media (max-width: 768px) {
      nav {
        flex-direction: column;
        text-align: center;
      }

      nav ul {
        margin-top: 10px;
      }

      .dashboard-overview {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <?php
  session_start();
  if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Member') {
      header("Location: login.php");
      exit();
  }
  ?>
  <header>
    <nav>
      <div class="logo-container">
        <a href="member_dashboard.php">
          <img src="word_of_faith_logo.png" alt="Church Logo" class="logo">
        </a>
        <span class="logo-text">WORD OF FAITH CHURCH INTERNATIONAL</span>
      </div>
      <ul>
        <li><a href="member_dashboard.php">Dashboard</a></li>
        <li><a href="view_events.php">View Events</a></li>
        <li><a href="volunteer_tasks.php">Volunteer Tasks</a></li>
        <li><a href="submit_prayer.php">Submit Prayer Request</a></li>
        <li><a href="youth.php">Youth Ministry</a></li>
        <li><a href="donate.php">Donate</a></li>
        <li><a href="join_department.php">Join Department</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
    <section class="dashboard-overview">
    <div class="card">
        <h2>View sermons</h2>
        <p>view sermons</p>
        <a href="view sermons.php" class="btn">view sermons</a>
      </div>
    <div class="card">
        <h2>Inspirations</h2>
        <p>Inspirations.</p>
        <a href="inspirations.php" class="btn">inspirations</a>
      </div>
    <div class="card">
        <h2>about us</h2>
        <p>about us.</p>
        <a href="about.php" class="btn">About us</a>
      </div>
    <div class="card">
        <h2>Fellowships</h2>
        <p>Check out fellowships.</p>
        <a href="fellowships.php" class="btn">Fellowships</a>
      </div>
    <div class="card">
        <h2>Youth Ministry</h2>
        <p>Check youth dashboard.</p>
        <a href="youth.php" class="btn">Youth Ministry</a>
      </div>
      <div class="card">
        <h2>View Events</h2>
        <p>Check out upcoming church events.</p>
        <a href="view_events.php" class="btn">View Events</a>
      </div>
      <div class="card">
        <h2>Volunteer Tasks</h2>
        <p>Sign up for volunteer tasks and serve your community.</p>
        <a href="volunteer_tasks.php" class="btn">View Tasks</a>
      </div>
      <div class="card">
        <h2>Submit Prayer Request</h2>
        <p>Submit your prayer request for support.</p>
        <a href="submit_prayer.php" class="btn">Submit Request</a>
      </div>
      <div class="card">
        <h2>Donate</h2>
        <p>Support the church by making a donation.</p>
        <a href="donate.php" class="btn">Donate Now</a>
      </div>
      <div class="card">
        <h2>Join Department</h2>
        <p>Become part of a church department.</p>
        <a href="join_department.php" class="btn">Join Now</a>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> Word of Faith Church International. All Rights Reserved.</p>
  </footer>
</body>
</html>
