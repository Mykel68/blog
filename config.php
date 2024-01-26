<?php

$host="localhost";
$user="root";
$password="";
$db="blog";

$conn=mysqli_connect($host,$user,$password,$db);

if($conn===false)
{
    die('Could not connect: '.mysqli_error());
}

?>