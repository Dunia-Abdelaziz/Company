<?php  
session_start();
require('connection.php');
if(isset($_POST['register'])){
    $name = strip_tags(trim($_POST['name']));
    $email = strip_tags(trim($_POST['email'])) ;
    $password = strip_tags(trim($_POST['password']));
  
  $errors = [];
  
  //name
  if(empty($name)){
      $errors[]= "name is required";
  }elseif(is_numeric($name)){
      $errors[]= "name must be string";
  }elseif(strlen($name)<1 || strlen($name) > 40){
      $errors[]="name size error";
  }
  
  
  //email
  if(empty($email)){
      $errors[]= "email is required";
  }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $errors[]= "is not valid email";
  }elseif(strlen($email) < 5 || strlen($email) > 40){
      $errors[]="email size error";
  }
  
  //password
  if(empty($password)){
      $errors[]= "password is required";
  }elseif(!preg_match("#[0-9]+#",$password)) {
      $errors[] = "Your Password Must Contain At Least 1 Number!";
  }
  elseif(!preg_match("#[A-Z]+#",$password)) {
      $errors[] = "Your Password Must Contain At Least 1 Capital Letter!";
  }
  elseif(!preg_match("#[a-z]+#",$password)) {
      $errors[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
  
  }elseif(strlen($password) <= 6 || strlen($password) > 40){
      $errors[]="password size error";
  }
  
 /* //image
  if($_FILES['img']['name']){
      $img = $_FILES['img'];
      $imgName = $img['name'];
      $imgTemName = $img['tmp_name'];
      $size = $img['size'];
      $ext = pathinfo($imgName,PATHINFO_EXTENSION);
      $sizeMb= $size/(1024*1024);
       $newName = uniqid().".".$ext;
       echo $newName;
  
  
      if($sizeMb > 1){
          $errors []="image size more than 1 MB";
      }elseif(!in_array(strtolower($ext),['jpg','png','jpeg'])){
          $errors []="image type not correct ";
  
      }
  
  }else{
      $newName ="default.jpg" ;
      echo $newName;
  }
*/
if(empty($errors)){
    $password= password_hash($password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (`name`,`email`,`password`)
    VALUES ('$name','$email','$password')";
    if(mysqli_query($conn,$sql)){
        $_SESSION['userId'] = mysqli_insert_id($conn);
        header("location: ../index.php");
    }else{
        $_SESSION['errors'] =["error while inserted"];
        header("location: ../register.php");
    }
       

}else{
  $_SESSION['errors'] = $errors;
  header('location: ../register.php');
}


}else{
    header('location: ../register.php');
}






?>