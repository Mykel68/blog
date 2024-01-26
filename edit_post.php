<?php
session_start();
require('config.php');
error_reporting(0);

if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Fetch the post details for the given ID
    $selectSql = "SELECT * FROM `posts` WHERE id = $postId";
    $selectResult = mysqli_query($conn, $selectSql);

    if ($selectResult) {
        $post = mysqli_fetch_assoc($selectResult);
    } else {
        echo "Error fetching post details: " . mysqli_error($conn);
        exit();
    }

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the updated values from the form
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $intro = mysqli_real_escape_string($conn, $_POST['intro']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);

        // Update the post in the database
        $updateSql = "UPDATE `posts` SET title = '$title', intro = '$intro', body = '$body' WHERE id = $postId";
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            echo '<div class="alert alert-success" role="alert">Post updated successfully</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error updating post: ' . mysqli_error($conn) . '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('head.php'); ?>

    <body>
        <div class="d-flex">
            <?php include 'sidebar.php'; ?>
            <div class="right">
                <div class="d-flex justify-content-center align-items-center flex-column h-100">
                    <h2>Edit Post</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $post['title']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="my-textarea">Introduction</label>
                            <textarea id="my-textarea" class="form-control" name="intro" rows="5" required><?php echo $post['intro']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="my-textarea">Body</label>
                            <textarea id="my-textarea" class="form-control" name="body" rows="15" required><?php echo $post['body']; ?></textarea>
                        </div>
                        <input type="submit" value="Update" name="submit" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="js/bootstrap.bundle.js"></script>
</html>
