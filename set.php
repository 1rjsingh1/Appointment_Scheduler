<?php
$date=$_GET['date'];
session_start();
$_SESSION['cdate']=$date;
header("Location:request2.php");
 ?>
