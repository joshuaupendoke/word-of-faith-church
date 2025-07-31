<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <link rel="stylesheet" href="logsign.css" />
  <!-- Font Awesome (for social media icons) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        session_start();
        include "config.php"; // Database connection file

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Check user in the database
            $sql = "SELECT id, name, password, role FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name, $hashed_password, $role);

            if ($stmt->fetch() && password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['name'] = $name;
                $_SESSION['role'] = $role;

                // Redirect based on role
                if ($role === "Admin") {
                    header("Location: admin_dashboard.php");
                }  else {
                    header("Location: member_dashboard.php");
                }
                exit();
            } else {
                echo "<p style='color:red;'>Invalid login credentials.</p>";
            }
        }
        ?>
        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="register.php">Don't have an account? Register</a>
    </div>
</body>
</html>
