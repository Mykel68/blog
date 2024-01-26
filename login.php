<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
    include('head.php');
    ?>
<body>
   <div class="d-flex justify-content-center align-items-center pt-5 flex-column">
    <h2 class="text-center mb-5">Login</h2>
   <form action="login_process.php" method="post">
        <div class="form-group">
        <label for="">Email</label>
        <input type="email"
            class="form-control" name="email" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password"
            class="form-control" name="password" id="" aria-describedby="helpId" placeholder="">
        </div>    
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger mt-3">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <button type="submit" class="btn btn-primary mt-3" name="login">Login</button>
    </form>
   </div>
    
</body>
</html>