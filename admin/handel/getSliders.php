<?php
$sql = "SELECT * FROM sliders ";
$query = mysqli_query($conn,$sql);

if(mysqli_num_rows($query) > 0){
$sliders = mysqli_fetch_all($query,MYSQLI_ASSOC);


}