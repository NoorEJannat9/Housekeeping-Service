<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $profile_picture = $_FILES['profile_picture']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($profile_picture);

    // Check file size and type (optional)
    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
        echo "File uploaded successfully!";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<form method="POST" action="upload_file.php" enctype="multipart/form-data">
    <input type="file" name="profile_picture">
    <button type="submit">Upload</button>
</form>
