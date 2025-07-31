<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
     <link rel="stylesheet" href="logsign.css" />
  <!-- Font Awesome (for social media icons) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php
        session_start();
        include "config.php"; // Database connection file

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role = $_POST['role']; // Admin, Member, or Pastor

            // Insert user into the database
            $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $password, $role);

            if ($stmt->execute()) {
                // Redirect to login page after successful registration
                header("Location: login.php?success=registered");
                exit();
            } else {
                echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
            }
        }
        ?>
        <form method="POST" action="register.php">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role">
                <option value="Member">Member</option>
                <option value="Pastor">Pastor</option>
                <option value="Admin">Admin</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>
