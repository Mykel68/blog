<?php
session_start();
require('config.php');

if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $field = $_POST['field'];
    $value = $_POST['value'];

    // Update the name in the database
    $updateSql = "UPDATE admin SET $field = '$value'";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        echo "Update successful";
    } else {
        echo "Update failed";
    }
} else {
    echo "Invalid request";
}
?>
