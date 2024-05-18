<?php

if(!isset( $_SESSION['adminId'])){
  header("location: login.php");
}

require('handel/connection.php');
$id = $_SESSION['adminId'];
$sql= "SELECT * FROM admins where id='$id'";
$query = mysqli_query($conn,$sql);
$adminLogin = mysqli_fetch_assoc($query);

?><nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TechStore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="add-services.php"><?= $message['add_servieces'] ?></a>
                  </li>

                <li class="nav-item active">
                    
                  <a class="nav-link" href="#"><?= $message['products'] ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><?= $message['categories'] ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="sliders.php"><?= $message['sliders'] ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="blogs.php"><?= $message['blogs'] ?></a>
                </li>
                <?php if($adminLogin['type']== "superadmin"){?>
                <li class="nav-item">
                  <a class="nav-link" href="admins.php"><?= $message['admins'] ?></a>
                </li>
               <?php } ?>
            </ul>
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item">
                  <a class="nav-link" href="handel/change-lang.php?lang=en">English</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="handel/change-lang.php?lang=ar">العربية</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?=$adminLogin['name']; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Profile</a>
                      <a class="dropdown-item" href="handel/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>