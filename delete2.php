<?php
session_start();
$id =$_SESSION['pid'];
$idd=$_GET['id'];
$date=$_GET['date'];
require("includes/conn.php");

$sq = "DELETE FROM Booking WHERE idp ='$id' and idd ='$idd' and date='".$date."'";

if (mysqli_query($con, $sq)) {
    mysqli_close($con);
    header("location:delete.php");
    exit;
} else {
    echo "Error deleting record";
}
?>
