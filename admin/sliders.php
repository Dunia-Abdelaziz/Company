<?php session_start(); ?>
 
<?php require('inc/head.php'); ?>
<body>
    
<?php require('inc/navbar.php'); ?>
<?php

require('handel/connection.php');



?>

    <div class="container-fluid py-5">
        <div class="row">

            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>All Sliders</h3>
                    <a href="add-slider.php" class="btn btn-success">
                        Add new
                    </a>
                </div>
                <?php
                 
                if(isset($_SESSION['errors'])){
                 foreach($_SESSION['errors'] as $error){?>
                     <div class="alert alert-info" role="alert">
                    <?php echo $error ;  ?>
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
                
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }

                $limit = 2;
                $offset = ($page - 1)*$limit;

                
                $sql = "SELECT count(id) as sliderCount from sliders";
                $query = mysqli_query($conn,$sql);
                $count = mysqli_fetch_assoc($query)['sliderCount'];
                $numberOfPage = ceil($count/$limit);
               

                if($page < 1 || $page > $numberOfPage){
                    header("location: sliders.php");
                }
                //getSlider
                $sql = "SELECT * FROM sliders limit $limit offset $offset";
                $query = mysqli_query($conn,$sql);

                if(mysqli_num_rows($query) > 0){
                $sliders = mysqli_fetch_all($query,MYSQLI_ASSOC);
                 }

             ?>
                

                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Header</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      if(isset($sliders)){
                                            
                      foreach($sliders as $index=>$slider) { ?>
                      <tr>
                        <th scope="row"><?=$index+1?></th>
                        <td><img style="width:25px" src="uploud/sliders/<?php echo $slider['image']?> "></td>
                        <td><?= $slider['header']; ?> </td>
                        <td><?= $slider['description']; ?> </td>
                        <td>
                            <a class="btn btn-sm btn-info" href="edit-slider.php?id=<?=$slider['id']?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="handel/delete-slider.php?id=<?=$slider['id']?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                      </tr>
                      <?php } 
                      }else{?>
                        <tr>
                          <td  colspan="6" class ="text-center"> no slider photo added </tr>
                      </tr>
                     <?php }?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                      <ul class="pagination">
                      <li class="page-item <?=($page==1)?'disabled':''?>"><a class="page-link" href="sliders.php?page=<?=$page-1?>">Previous</a></li>
                      <?php for($i=1; $i <= $numberOfPage;$i++) { ?>
                      <li class="page-item"><a class="page-link" href="sliders.php?page=<?=$i?>"><?= $i?></a></li>
                      <?php  } ?>
                      <li class="page-item <?=($page==$numberOfPage)?'disabled':''?>"><a class="page-link" href="sliders.php?page=<?=$page+1?>">Next</a></li>
                      </ul>
                </nav>


            </div>

        </div>
    </div>
    <?php require('inc/footer.php'); ?>