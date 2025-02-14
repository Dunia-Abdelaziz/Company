<?php session_start(); ?>
 
<?php require('inc/head.php') ; ?>
<body>
    
<?php require('inc/navbar.php') ; ?>

    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Add Category</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form>
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control">
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-dark" href="#">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <?php require('inc/footer.php') ; ?>