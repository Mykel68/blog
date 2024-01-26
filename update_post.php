<?php
session_start();
require('config.php');
error_reporting(0);

if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

$sql = "SELECT * FROM `posts`";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('head.php'); ?>

    <body>
        <div class="d-flex">
            <?php include 'sidebar.php'; ?>
            <div class="right">
                <div class="d-flex justify-content-center align-items-center flex-column h-100">
                    <h2>All Posts</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Format date if needed
                                    $formattedDate = date('Y-m-d H:i:s', strtotime($row['timestamp']));

                                    echo "<tr>
                                            <td>{$row['title']}</td>
                                            <td>{$formattedDate}</td>
                                            <td><a class='btn btn-primary' href='edit_post.php?id={$row['id']}'>Edit</a></td>
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
