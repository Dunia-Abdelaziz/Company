<?php
session_start(); 
require('connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
$sql = "SELECT * FROM admins where id=$id";
$query = mysqli_query($conn,$sql);
       if(mysqli_num_rows($query) > 0){

        $admin = mysqli_fetch_assoc($query);
        $oldImage=$admin['image'];
        $name = strip_tags(trim($_POST['name']));
        $email = strip_tags(trim($_POST['email'])) ;
        $status= $_POST['status'];
        $type= $_POST['type'];
        $errors = [];

        //name
        if(empty($name)){
            $errors[] = "name is required";
        }elseif(is_numeric($name)){
            $errors[] = "name must be text";
        }elseif(strlen($name)<=2 || strlen($name) > 40){
            $errors[] = "name must betweem 3 and 40";
        }

        //email
        if(empty($name)){
            $errors[] = "name is required";
        }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors[]= "is not valid email";
        }elseif(strlen($name)<=2 || strlen($name) > 40){
            $errors[] = "name must betweem 3 and 40";
        }

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
            $sql = "UPDATE admins SET name ='$name',email = '$email',status='$status',image= '$newImage',type= '$type' where id=$id";
           
            if(mysqli_query($conn,$sql)){
            if($_FILES['img']['name']){
                move_uploaded_file($imgTmpName,"../uploud/$newImage");
                //move_uploaded_file($newImage);
                unlink("../uploud/$oldImage");
           }
           $_SESSION['success']  = "data updated";
           header('location: ../admins.php') ;
          
        }else{
            $_SESSION['errors'] ="error while editing";
        header("location: ../edit-admin.php");

        }
        

       }else{
        $_SESSION['errors'] = $errors;
        header("location: ../admins.php");

       }
    
    }else{
        $_SESSION['errors'] ="admin not found";
        header("location: ../admins.php");
    }
}else{
    header("location: ../admins.php");
}
?>