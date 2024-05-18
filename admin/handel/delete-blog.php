<?php
session_start(); 
require('connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
$sql = "SELECT * FROM blogs where id=$id";
$query = mysqli_query($conn,$sql);
       if(mysqli_num_rows($query) > 0){

        $admin = mysqli_fetch_assoc($query);
        $img = $admin['image'];
        unlink("../uploud/blogs/$img");
        
        
         $sql = "DELETE FROM blogs WHERE id=$id";
        $result = mysqli_query($conn,$sql);

if($result){
$_SESSION['success'] = "blog was deleted";
header("location: ../blogs.php");

}
}else{
    $_SESSION['errors'] = ["no blog found"];
    header("location: ../blogs.php");
}


}else{
    
    header("location: ../blogs.php");
}







?>