<?php
require_once('config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header('location:login.php?error=empty');
        $_SESSION['error'] = "All fields are required";
        exit();
    }

    $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $admin['email'];
    
        // Debugging statement
        echo "Email set in session: " . $_SESSION['email'];
    
        header('location:dashboard.php');
        exit();
    } else {
        header('location:login.php?error=invalid');
        $_SESSION['error'] = "Invalid email or password";
        exit();
    }
}
?>
