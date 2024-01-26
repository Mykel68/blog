<?php
session_start();
require('config.php');

// Get post ID from the URL
if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    $sql2 = "SELECT * FROM `posts`";
    $result2 = $conn->query($sql2);

    // Fetch post details from the database
    $sql = "SELECT * FROM `posts` WHERE id = $postId";
    $result = $conn->query($sql);

    include('head.php');
    include('navbar.php');

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display post details
        echo '<div class="container mt-3 p-5">';
        echo '<div class="row">';

        // Image path without timestamp
        $imagePath = 'uploads/' . $row['image'];

        echo '<div class="col-md-9">';
        echo '<h2 class="text-center p-2">' . $row['title'] . '</h2>';

        // Check if the image file exists before displaying it
        if (file_exists($imagePath)) {
            echo '<img class="post-image" src="' . $imagePath . '" alt="post image" style="width:100%;height:300px">';
        } else {
            echo '<p>Image not found</p>';
        }

        echo '<div class="post-details">';
        echo '<p class="post-intro bg-primary bg-opacity-10 p-2 border-start border-5 ">' . $row['intro'] . '</p>';
        echo '<br>';
        echo '<p class="post-body">' . $row['body'] . '</p>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>Post not found</p>';
    }
} else {
    echo '<p>Invalid request</p>';
}
?>
<div class="col-md-3 d-flex flex-md-column flex-wrap accordion ">
    <h2 class="text-center p-2">Other Posts</h2>
    <?php

    if($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            echo '<div class="" style="max-width:250px">';
            echo '<a class="text-decoration-none" href="post_details.php?id=' . $row2['id'] . '">';
            echo '<div class="border border-1 p-2 m-1 overflow-hidden " style="height:163px">';
            echo '<h3 class="post-title">' . $row2['title'] . '</h3>';
            echo '<p class="post-intro">' . $row2['intro'] . '</p>';
            echo '</div>';
            echo '</a>';
        }
    }

    ?>
</div>
</div>
</body>
<script src="js/bootstrap.bundle.js"></script>
</html>
