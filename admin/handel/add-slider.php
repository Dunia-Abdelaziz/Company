<?php
 
session_start();

 require('connection.php');
 
  $header = strip_tags(trim($_POST['header']));
  $desc = strip_tags(trim($_POST['desc'])) ;
 

$errors = [];



//image
if($_FILES['img']['name']){
    $img = $_FILES['img'];
    $imgName = $img['name'];
    $imgTemName = $img['tmp_name'];
    $size = $img['size'];
    $ext = pathinfo($imgName,PATHINFO_EXTENSION);
    $sizeMb= $size/(1024*1024);
     $newName = uniqid().".".$ext;
     


    if($sizeMb > 1){
        $errors []="image size more than 1 MB";
    }elseif(!in_array(strtolower($ext),['jpg','png','jpeg'])){
        $errors []="image type not correct ";

    }



}


echo '<pre>';
print_r($errors);
echo '</pre>';
if(empty($errors)){

    
    $sql = "INSERT INTO sliders (`header`,`description`,`image`)
    VALUES ('$header','$desc','$newName')";
    
    if(mysqli_query($conn,$sql)){
      
        move_uploaded_file($imgTemName,"../uploud/sliders/$newName");
        
    
      $_SESSION['success'] = "data inserted";
      header("location: ../add-slider.php");
    }else{
        $_SESSION['errors'] ="error while inserted";
        header("location: ../add-slider.php");
    }

    
}else{
    $_SESSION['errors'] = $errors;
    header("location: ../add-slider.php");
}




?>