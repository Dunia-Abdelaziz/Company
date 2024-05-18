<?php
session_start();
require('connection.php');
if(isset($_POST['insComment'])){
    $content= $_POST['comment'];
    $userId = $_SESSION['userId'];
    $blogId = $_POST['blog_id'];
    
    $sql = "INSERT INTO comments(`content`,`user_id`,`blog_id`)
    VALUES('$content','$userId','$blogId')";
    if(mysqli_query($conn,$sql)){
    
       header("location: ../blog-single.php?id=$blogId");
    }
}else{
    header("location: ../blog-single.php");
}





?>