<?php
session_start();
if(isset( $_SESSION['adminId'])){
    header("location: index.php");
  }
?>
 
<?php 

require('inc/head.php') ; ?>
<body>
    

    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Login</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form method= "POST" action = "handel/login.php">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" name="password" class="form-control">
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
                               if(isset($_SESSION['success'])){?>
                                <div class="alert alert-info" role="alert">
                               <?php echo $_SESSION['success'];   ?>
                                </div>
                               <?php                        
                                unset($_SESSION['success']);
                               }

                        ?>
                            <div class="text-center mt-5">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
        <?php require('inc/footer.php') ; ?>