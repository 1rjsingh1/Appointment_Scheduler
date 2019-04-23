<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require("/includes/conn.php");
    include_once("/includes/template.php"); ?>
    <script type="text/javascript" src="includes/jquery.min.js" ></script>
    <script type="text/javascript" src="includes/jquery.table2excel.min.js" ></script>

    <script type="text/javascript" >

    	$(document).ready(function(e) {

    		$("#myButton").click(function(e) {

    			$("#mytable").table2excel({
    					name : "new File",
    					filename: "newfile",
    					fileext: ".xls"

    				});
            });

        });

    </script>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container" style="margin-left:240px;">


      <div class="container">
        <center>
        <table id="mytable" class="table table-bordered">
    <tr><td colspan="8"><center><h1> Details Of Appointment</h1></center>
    </td>
  </tr>
  <tr></tr>
  <tbody>
    <tr>
      <td>Name of Patient</td>
      <td><?php

      $idd=$_COOKIE["doc_id"];
      $idp=$_SESSION["pid"];
            $quer="Select register.name rname,doctors.name dname,hospital,date,time,descpt from booking,register,doctors where
            booking.idd=".$idd." and booking.idp=".$idp." and booking.date='".$_SESSION['cdate']."' and
            doctors.idd=".$idd." and register.idp=".$idp;
            $res=mysqli_query($con,$quer);
            $fetch=mysqli_fetch_assoc($res);


            echo $fetch['rname'];

            ?></td>
    </tr>
    <tr>
      <td>Doctor</td>
      <td><?php echo $fetch['dname']; ?></td>
    </tr>
    <tr>
      <td>Hospital</td>
      <td><?php echo $fetch['hospital']; ?></td>
    </tr>
    <tr>
      <td>Date</td>
      <td><?php echo $fetch['date']; ?></td>
    </tr>
    <tr>
      <td>Time</td>
      <td><?php echo $fetch['time']; ?></td>
    </tr>
    <tr>
      <td>Description</td>
      <td><?php echo $fetch['descpt']; ?></td>
    </tr>
  </tbody>
</table>
<center><button id="myButton" type="button" class="btn btn-primary btn-lg">Click to download excel</button></center>



    </div>

  </body>
</html>
