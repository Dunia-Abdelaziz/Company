<?php
session_start(); 
require('connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
$sql = "SELECT * FROM blogs where id=$id";
$query = mysqli_query($conn,$sql);
       if(mysqli_num_rows($query) > 0){

        $blog = mysqli_fetch_assoc($query);
        $oldImage=$blog['image']; 
        $title = strip_tags(trim($_POST['title']));
        $sdesc = strip_tags(trim($_POST['s_desc'])) ;
        $ldesc = strip_tags(trim($_POST['l_desc'])) ;
        $admin = strip_tags(trim($_POST['admin'])) ;
        $errors = [];

        

        //image
        if($_FILES['img']['name']){
            $img= $_FILES['img'];
            $imageName = $img['name'];
            $imgTmpName= $img['tmp_name'];
            $ext = pathinfo($imageName,PATHINFO_EXTENSION);
            $size =$img['size'];
            $sizeMb =$size/(1024*1024);
            $newImage= uniqid().".".$ext;
            if($sizeMb > 1){
                $errors[]="size of image must less than 1";
            }elseif(!in_array(strtolower($ext),['jpg','png','jpeg'])){
                $errors []="image type not correct ";  

            }
          

        }else{
            $newImage=$oldImage;
        }


        if(empty($errors)){
            $sql = "UPDATE blogs SET title ='$title',short_description = '$sdesc',long_description='$ldesc',image= '$newImage',admin_id= '$admin' where id=$id";
           
            if(mysqli_query($conn,$sql)){
            if($_FILES['img']['name']){
                move_uploaded_file($imgTmpName,"../uploud/blogs/$newImage");
                //move_uploaded_file($newImage);
                unlink("../uploud/blogs/$oldImage");
           }
           $_SESSION['success']  = "data updated";
           header('location: ../blogs.php') ;
          
        }else{
            $_SESSION['errors'] ="error while editing";
        header("location: ../edit-admin.php");

        }
        

       }else{
        $_SESSION['errors'] = $errors;
        header("location: ../blogs.php");

       }
    
    }else{
        $_SESSION['errors'] ="admin not found";
        header("location: ../blogs.php");
    }
}else{
    header("location: ../blogs.php");
}
?>