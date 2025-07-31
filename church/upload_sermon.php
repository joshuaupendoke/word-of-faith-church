<?php
session_start();
include "config.php";

// Check if user is an Admin or Pastor
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Pastor')) {
    echo "Access Denied!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $uploaded_by = $_SESSION['user_id'];

    // File upload logic
    $target_dir = "uploads/sermons/";
    $file_name = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $query = "INSERT INTO sermons (title, description, file_path, uploaded_by) VALUES ('$title', '$description', '$target_file', $uploaded_by)";
        mysqli_query($conn, $query);
        echo "Sermon uploaded successfully!";
    } else {
        echo "File upload failed.";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Sermon Title" required>
    <textarea name="description" placeholder="Sermon Description" required></textarea>
    <input type="file" name="file" accept=".mp3,.mp4,.pdf" required>
    <button type="submit">Upload Sermon</button>
</form>
