<?php
session_start();
require('config.php');
$sql = "SELECT * FROM `posts` ORDER BY `timestamp` DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>View Posts</title>
</head>

<body>
<?php
include('navbar.php');
?>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-9">
            <h2 class="text-center p-3">Hot Topics</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="post-container">';
                echo '<div class="post-image-container">';
                
                // Remove timestamp from image name (if any)
                $image = preg_replace("/\.[0-9]{10,}$/", "", $row['image']);
                $imagePath = 'uploads/' . $image;
                
                // Check if the image file exists before displaying it
                if (file_exists($imagePath)) {
                    echo '<img class="post-image" src="' . $imagePath . '" alt="post image">';
                } else {
                    echo '<p>Image not found</p>';
                }
                
                echo '</div>';
                echo '<h3 class="post-title">' . $row['title'] . '</h3>';
                echo '<p class="post-intro overflow-hidden p-1" style="max-height: 3.6em;">' . $row['intro'] . '</p>';
                echo '<p class="post-intro">' . date('d F Y', strtotime($row['timestamp'])) . '</p>';
                echo '<a class="btn btn-info" href="post_details.php?id=' . $row['id'] . '">Read More</a>';
                echo '</div>';
            }
        } else {
            echo '<p>No posts available</p>';
        }
        ?>
            </div>
        </div>
    </div>
<script src="js/bootstrap.bundle.js"></script>
</body>
</html>
