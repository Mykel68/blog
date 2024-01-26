<?php
session_start();
require('config.php');
error_reporting(0);

if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

// Check if the delete parameter is set in the URL
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Perform the delete operation
    $deleteSql = "DELETE FROM `posts` WHERE id = $deleteId";
    $deleteResult = mysqli_query($conn, $deleteSql);

    // Redirect to the same page after the delete operation
    header("location:delete_post.php");
    exit();
}

// Fetch all posts
$sql = "SELECT * FROM `posts`";
$result = mysqli_query($conn, $sql);
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
                <div class="d-flex justify-content-center align-items-center flex-column h-100">
                    <h2>All Posts</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Format date if needed
                                    $formattedDate = date('Y-m-d H:i:s', strtotime($row['date']));

                                    echo "<tr>
                                            <td>{$row['title']}</td>
                                            <td>{$formattedDate}</td>
                                            <td><a class='btn btn-danger' href='delete_post.php?delete_id={$row['id']}'>Delete</a></td>
                                          </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script src="js/bootstrap.bundle.js"></script>
</html>
