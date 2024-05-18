<?php
session_start(); 
require('connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
$sql = "SELECT * FROM admins where id=$id";
$query = mysqli_query($conn,$sql);
       if(mysqli_num_rows($query) > 0){

        $admin = mysqli_fetch_assoc($query);
        $img = $admin['image'];
        if($img != "default.jpg"){
            unlink("../uploud/$img");
        }
        
         $sql = "DELETE FROM admins WHERE id=$id";
        $result = mysqli_query($conn,$sql);

if($result){
$_SESSION['success'] = "admin was deleted";
header("location: ../admins.php");

}
}else{
    $_SESSION['errors'] = ["no admin found"];
    header("location: ../admins.php");
}


}else{
    
    header("location: ../admins.php");
}







?>