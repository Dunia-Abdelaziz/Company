<?php
 
session_start();

 require('connection.php');
 
  $title = strip_tags(trim($_POST['title']));
  $sdesc = strip_tags(trim($_POST['s_desc'])) ;
  $ldesc = strip_tags(trim($_POST['l_desc'])) ;
  $id = $_SESSION['adminId'];
 

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

    
    $sql = "INSERT INTO blogs (`title`,`long_description`,`short_description`,`image`,`admin_id`)
    VALUES ('$title','$ldesc','$sdesc','$newName','$id')";
    
    if(mysqli_query($conn,$sql)){
      
        move_uploaded_file($imgTemName,"../uploud/blogs/$newName");
        
    
      $_SESSION['success'] = "data inserted";
      header("location: ../add-blog.php");
    }else{
        $_SESSION['errors'] ="error while inserted";
        header("location: ../add-blog.php");
    }

    
}else{
    $_SESSION['errors'] = $errors;
    header("location: ../add-blog.php");
}




?>