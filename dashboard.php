<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:login.php");
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
            <?php
                include 'home.php';
            ?>
        </div>
    </div>
    
    
</body>
<script src="js/bootstrap.bundle.js"></script>
</html>