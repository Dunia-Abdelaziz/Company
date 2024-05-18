<?php
session_start(); 
require('connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
$sql = "SELECT * FROM sliders where id=$id";
$query = mysqli_query($conn,$sql);
       if(mysqli_num_rows($query) > 0){

        $admin = mysqli_fetch_assoc($query);
        $img = $admin['image'];
        unlink("../uploud/sliders/$img");
        
        
         $sql = "DELETE FROM sliders WHERE id=$id";
        $result = mysqli_query($conn,$sql);

if($result){
$_SESSION['success'] = "slider was deleted";
header("location: ../sliders.php");

}
}else{
    $_SESSION['errors'] = ["no slider found"];
    header("location: ../sliders.php");
}


}else{
    
    header("location: ../sliders.php");
}







?>