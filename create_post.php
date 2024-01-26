<?php
error_reporting(0);


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

    move_uploaded_file($image_temp, "uploads/$image");

    // Debug: Check if file upload is successful
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        echo 'File upload failed with error code: ' . $_FILES['image']['error'];
        exit;
    }



    $sql = "INSERT INTO posts (title, intro, body, image) VALUES ('$title', '$intro', '$body', '$image')";



    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = '<div class="alert alert-success" role="alert">Post created successfully</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . mysqli_error($conn) . '</div>';
    }
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
                    class="form-control" name="title" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="my-textarea">Introduction</label>
                    <textarea id="my-textarea" class="form-control" name="intro" rows="5"></textarea>
                </div>
                <div class="form-group">
                  <label for="">Image</label>
                  <input type="file"
                    class="form-control" name="image" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="my-textarea">Body</label>
                    <textarea id="my-textarea" class="form-control" name="body" rows="15"></textarea>
                </div>
                <input type="submit" value="Create" name="submit" class="btn btn-primary mt-3">
            </form>
        </div>
    </div>
</body>
<script src="js/bootstrap.bundle.js"></script>
</html>
