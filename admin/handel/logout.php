<?php
session_start();
unset( $_SESSION['adminId']);
header("location: ../login.php"); 

?>