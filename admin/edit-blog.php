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
$sql = "SELECT * FROM blogs where id=$id";
$query = mysqli_query($conn,$sql);
       if(mysqli_num_rows($query) > 0){
       
        $blog = mysqli_fetch_assoc($query);
        $sql = "SELECT id,name FROM admins";
        $query = mysqli_query($conn,$sql);  
        $admins = mysqli_fetch_all($query,MYSQLI_ASSOC);  
        
        ?> 
<div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">edit blog</h3>
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

                        <form  method = "POST" action = "handel/update-blog.php?id=<?=$id?>"
                        enctype = "multipart/form-data" >

                            <div class="form-group">
                              <label>Title</label>
                              <input type="text" name="title" value ="<?= $blog["title"]?>" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>short description</label>
                              <textarea type="text" name="s_desc"  class="form-control"><?= $blog["short_description"]?></textarea>
                            </div>


                            <div class="form-group">
                              <label>long description</label>
                              <textarea type="text" name="l_desc" class="form-control"><?= $blog["long_description"]?> </textarea>
                            </div>

                            <div class="form-group" >
                              <label>admin</label>
                              <select class="form-control" name ="admin">
                                <?php foreach($admins as $admin) {?>
                              <option value ="<?= $admin['id']?>"> <?= $admin['name']  ?> </option>
                              <?php }?>
                              </select>
                            </div>

                        
                            <div class="custom-file">
                                <input type="file"  name="img" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div>
                            
                            <div class="mt-3" >
                                <img class ="img-fluid d-block m-auto" style= "height:100px"src ="uploud/blogs/<?=$blog['image'] ?>">
                            </div>
                              
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">update</button>
                                <a class="btn btn-dark" href="blogs.php">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php require('inc/footer.php'); 

                    }else{
                        $_SESSION['errors'] =["blog not found"];
                        header("location: blogs.php");
                    }
}else{
    
    header("location: ../blogs.php");
}
?>