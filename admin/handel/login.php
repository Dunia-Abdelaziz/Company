<?php
session_start();

require('connection.php');
if(isset($_POST['login'])){
    $email = strip_tags(trim( $_POST['email']));
    $password = strip_tags(trim( $_POST['password']));
    $errors =[];

    //email
    if(empty($email)){
        $errors[]="email is required";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[]="enter valid email";
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

       if(empty($errors)){
            $sql = "SELECT * FROM admins where email='$email'";
            $query = mysqli_query($conn,$sql);
            if(mysqli_num_rows($query) > 0){
                $admin = mysqli_fetch_assoc($query);
                $adminPassword = $admin['password'];
                if(password_verify($password,$adminPassword)){
                    
                    $_SESSION['adminId']= $admin['id'];
                    header("location: ../index.php");

                }else{
                    $_SESSION['errors']= ['password not correct'];
                    header("location: ../login.php");
                }

            }else{
                $_SESSION['errors'] = ['email not exist'];
                header("location: ../login.php");
            }



        }else{
            $_SESSION['errors'] = $errors;
            header("location: ../login.php");
        }


   
}else{
    header("location: ../login.php");
}



?>