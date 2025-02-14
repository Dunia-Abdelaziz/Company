<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Signin </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/css/signin/bootstrap.min.css" rel="stylesheet">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/signin/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<form class="form-signin" method="POST" action= "handel/register.php" >
  <img class="mb-4" src="assets/css/signin/login.jpg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Creat account</h1>

  <label for="inputName" class="sr-only">User Name</label>
  <input type="text" name="name" id="inputEmail" class="form-control" placeholder="user name" required autofocus>

  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password"  id="inputPassword" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <?php
                 
                 if(isset($_SESSION['errors'])){
                  foreach($_SESSION['errors'] as $error){?>
                      <div class="alert alert-info" role="alert">
                     <?php echo $error;  ?>
                      </div>
                   <?php                        
                  }
                  unset($_SESSION['errors']);
                 }
                 
              ?>

  <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Sign up</button>

  <p class="mt-5 mb-3 text-muted">&copy; 2017-2022</p>
</form>


    
  </body>
</html>
