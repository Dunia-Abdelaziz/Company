<?php session_start(); ?>
 
<?php require('inc/head.php'); ?>
<body>
    
<?php require('inc/navbar.php'); 
if($adminLogin['type'] == "admin")
header("location: index.php");
?>
<?php

require('handel/connection.php');
$sql = "SELECT * FROM admins";
$query = mysqli_query($conn,$sql);

if(mysqli_num_rows($query) > 0){
$admins = mysqli_fetch_all($query,MYSQLI_ASSOC);


}else{

}

?>

    <div class="container-fluid py-5">
        <div class="row">

            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3><?= $message['all_admins'] ?></h3>
                    <a href="add-admin.php" class="btn btn-success">
                    <?= $message['add_new'] ?>
                    </a>
                </div>
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
                

                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?= $message['name'] ?></th>
                        <th scope="col"><?= $message['email'] ?></th>
                        <th scope="col"><?= $message['status'] ?></th>
                        <th scope="col"><?= $message['type'] ?></th>
                        <th scope="col"><?= $message['created_at'] ?></th>
                        <th scope="col"><?= $message['action'] ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      if(isset($admins)){
                                            
                      foreach($admins as $index=>$admin) { ?>
                      <tr>
                        <th scope="row"><?=$index+1?></th>
                        <td><?= $admin['name']; ?> </td>
                        <td><?= $admin['email']; ?> </td>
                        <td><?php if($admin['status'] == 1){?>
                          <i class="far fa-check-circle"></i>

                        <?php }else{?>
                          <i class="far fa-times-circle"></i>
                      <?php } 
                        ?> </td>
                        <td><?= $admin['type']; ?> </td>
                        <td><?= $admin['created_at']; ?> </td>
                        <td>
                            <a class="btn btn-sm btn-info" href="edit-admin.php?id=<?=$admin['id']?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="handel/delete-admin.php?id=<?=$admin['id']?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                      </tr>
                      <?php } 
                      }else{?>
                        <tr>
                          <td  colspan="6" class ="text-center"> no admin add </tr>
                      </tr>
                     <?php }?>
                    </tbody>
                </table>
                
            </div>

        </div>
    </div>
    <?php require('inc/footer.php'); ?>