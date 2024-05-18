<?php
session_start(); 
require('handel/connection.php');

?>
         
<?php require('inc/head.php'); ?>
<body>
    
<?php require('inc/navbar.php');
if($adminLogin['type'] == "admin")
header("location: index.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
$sql = "SELECT * FROM admins where id=$id";
$query = mysqli_query($conn,$sql);
       if(mysqli_num_rows($query) > 0){
       
        $admin = mysqli_fetch_assoc($query);
        
        
        ?> 
<div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">edit admin</h3>
                <div class="card">
                    <div class="card-body p-5">
                    <?php 
                       if(isset($_SESSION['errors'])){
                        foreach($_SESSION['errors'] as $error){?>
                            <div class="alert alert-info" role="alert">
                           <?php echo $error."----";  ?>
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

                        <form  method = "POST" action = "handel/update-admin.php?id=<?=$id?>"
                        enctype = "multipart/form-data" >

                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" name="name" value ="<?= $admin["name"]?>" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" value ="<?= $admin["email"]?>" class="form-control">
                            </div>

                            <div class="form-group" >
                              <label>status</label>
                              <select class="form-control" name ="status">
                              <option value= "1" <?php if($admin['status']== 1) echo "selected";  ?> >active </option>
                              <option value= "0" <?php if($admin['status']== 0) echo "selected";  ?> > not active </option>
                              </select>
                            </div>

                            <div class="form-group" >
                              <label>Type</label>
                              <select class="form-control" name ="type">
                              <option value= "admin" <?php if($admin['type']== "admin") echo "selected";  ?> >admin </option>
                              <option value= "superadmin" <?php if($admin['type']== "superadmin") echo "selected";  ?> > super admin </option>
                              </select>
                            </div>

                            <div class="custom-file">
                                <input type="file"  name="img" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div>
                            
                            <div class="mt-3" >
                                <img class ="img-fluid d-block m-auto" style= "height:100px"src ="uploud/<?=$admin['image'] ?>">
                            </div>
                              
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">update</button>
                                <a class="btn btn-dark" href="admins.php">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php require('inc/footer.php'); 

                    }else{
                        $_SESSION['errors'] =["admin not found"];
                        header("location: admins.php");
                    }
}else{
    
    header("location: ../admins.php");
}
?>