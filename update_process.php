<?php
session_start();
require('config.php');

if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $postId = mysqli_real_escape_string($conn, $_POST['post_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $intro = mysqli_real_escape_string($conn, $_POST['intro']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);

    // Check if the image file is uploaded
    if (!empty($_FILES['image']['name'])) {
        // Handle image upload if needed
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];

        move_uploaded_file($image_temp, "uploads/$image");

        // Update the post with the new image
        $updateSql = "UPDATE posts SET title = '$title', intro = '$intro', body = '$body', image = '$image' WHERE id = $postId";
    } else {
        // Update the post without changing the existing image
        $updateSql = "UPDATE posts SET title = '$title', intro = '$intro', body = '$body' WHERE id = $postId";
    }

    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        // Redirect to the view posts page or any other page
        header("location:view_posts.php");
        exit();
    } else {
        // Handle update error
        echo "Error updating post: " . mysqli_error($conn);
    }
} else {
    // Redirect to the edit page if the form is not submitted
    header("location:update.php?id=$postId");
    exit();
}
?>
