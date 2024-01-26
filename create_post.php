<?php
session_start();
require('config.php');


$message = '';

if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $intro = mysqli_real_escape_string($conn, $_POST['intro']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    if ($_FILES['image']['error'] > 0) {
        echo 'Error: ' . $_FILES['image']['error'];
        exit;
    }
    
    move_uploaded_file($image_temp, "uploads/$image");

    // Include the timestamp column in the INSERT statement
    $sql = "INSERT INTO posts (title, intro, body, image, timestamp) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)";
    
    $stmt = mysqli_prepare($conn, $sql);

    // Use 's' for strings and 'b' for blobs (binary data, like images)
    mysqli_stmt_bind_param($stmt, "sssb", $title, $intro, $body, $image);
    
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $message = '<div class="alert alert-success" role="alert">Post created successfully</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error creating post. Please try again.</div>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php
    include('head.php');
    ?>
<body>
    <div class="d-flex">
        <?php
            include 'sidebar.php';
        ?>
        <div class="right">
            <h2>Create Post</h2>

            <!-- Display Bootstrap alert here -->
            <?php echo $message; ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Title</label>
                  <input type="text"
                    class="form-control" name="title" id="" aria-describedby="helpId" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="my-textarea">Introduction</label>
                    <textarea id="my-textarea" class="form-control" name="intro" rows="5" required></textarea>
                </div>
                <div class="form-group">
                  <label for="">Image</label>
                  <input type="file"
                    class="form-control" name="image" id="" aria-describedby="helpId" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="my-textarea">Body</label>
                    <textarea id="my-textarea" class="form-control" name="body" rows="15" required></textarea>
                </div>
                <input type="submit" value="Create" name="submit" class="btn btn-primary mt-3">
            </form>
        </div>
    </div>
</body>
<script src="js/bootstrap.bundle.js"></script>
</html>
