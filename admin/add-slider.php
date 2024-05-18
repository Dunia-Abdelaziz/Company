
<?php  session_start(); ?>
 
<?php require('inc/head.php'); ?>
<body>
    
<?php require('inc/navbar.php'); ?>

    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Add Slider</h3>
                <div class="card">
                    <div class="card-body p-5">
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

                        <form  method = "POST" action = "handel/add-slider.php"
                        enctype = "multipart/form-data" >

                            <div class="form-group">
                              <label>Header</label>
                              <input type="text" name="header" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>Description</label>
                              <textarea type="email" name="desc" class="form-control"></textarea>
                            </div>
                          
                            
                            <div class="custom-file">
                                <input type="file"  name="img" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div>
                              
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">add</button>
                                <a class="btn btn-dark" href="admins.php">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php require('inc/footer.php'); ?>