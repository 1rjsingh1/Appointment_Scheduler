<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
        $base="\"http://localhost/appointments/\""; ?>
    <?php include ("includes\conn.php"); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <meta charset="utf-8">
    <script type="text/javascript" >


    function mov1(idp,date,tim,idd)
    {
      var d = new Date();
    d.setTime(d.getTime() + (24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie="doc_id="+idd+";"+expires+";path=/";
    document.cookie="pa_id="+idp+";"+expires+";path=/";
    document.cookie="date="+date+";"+expires+";path=/";
console.log(idp);
  //  location.href=<?php echo $base; ?>+ "confirmed.php?tim="+tim;


    }
    function mov2(idp,date,tim,idd)
    {
      var d = new Date();
    d.setTime(d.getTime() + (24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie="doc_id="+idd+";"+expires+";path=/";
    document.cookie="pa_id="+idp+";"+expires+";path=/";
    document.cookie="date="+date+";"+expires+";path=/";

    location.href=<?php echo $base; ?>+ "cancelled.php?tim="+tim;


    }
    </script>
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Welcome <?php
            session_start();
            echo $_SESSION['name'];
        ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="dochome.php">Home <span class="sr-only">(current)</span></a>
          </li>


        </ul>
        <form class="form-inline my-2 my-lg-0">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" ><a href="login/doclog.php">Logout</a></button>
        </form>
      </div>
    </nav>

    <div class="container">
      <table class="table table-hover">
<thead>
<tr>
<th scope="col">Serial No.</th>
<th scope="col">Patient Name</th>
<th scope="col">Date</th>
<th scope="col">Time</th>
<th scope="col">Description</th>
<th scope="col" colspan="2">Confirm Booking</th>
</tr>
</thead>
<tbody>

      <?php

      $idp=$_SESSION['pid'];
      $c=time();
      //India time (GMT+5:30)




      $query="Select register.name dname,register.idp,date,time,descpt,confirm from booking,register where
     booking.idd=".$idp." and register.idp=booking.idp";

    $result=mysqli_query($con,$query);
    $count=mysqli_num_rows($result);
    if($count==0)
    {
      echo "<h1>"."No record Found"."</h1>";
    }
    else
    {


$count=mysqli_num_rows($result);

 if($count>0){
   $sera=0;
  while($fetch=mysqli_fetch_assoc($result)){

    $piecea = explode(" ", $fetch['time']);
    $btimea=$fetch['date']." ".$piecea[0].":00 ".$piecea[1];
    date_default_timezone_set("Asia/Calcutta");
    $booktimea=strtotime($btimea);
    if($booktimea>$c && $fetch['confirm']==0)
    {
        $sera=$sera+1;
			echo "<tr>";
echo "<td>" .$sera . "</td>";
echo "<td>" .$fetch['dname'] . "</td>";
 echo "<td>" .$fetch['date'] . "</td>";
      echo "<td>" .$fetch['time']. "</td>";
      echo "<td>" .$fetch['descpt']."</td>";
      echo "<td><button class='btn btn light' onclick='mov1(".$fetch['idp'].",\"".$fetch['date']."\",\"".$fetch['time']."\",".$idp.")' ><i class='fas fa-check-circle' style='color:green'; font-size:20px;'</i></button></td>";
      echo "<td><button class='btn btn light' onclick='mov2(".$fetch['idp'].",\"".$fetch['date']."\",,\"".$fetch['time']."\"".$idp.")' ><i class='fas fa-times-circle' style='color:green'; font-size:20px;'</i></button></td>";


echo "</tr>";

}}
}

    echo "</tbody></table>  ";
}
    ?>
    <script type="text/javascript" >


    function mov1(idp,date,time,idd)
    {
      var d = new Date();
    d.setTime(d.getTime() + (24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie="doc_id="+idd+";"+expires+";path=/";
    document.cookie="pa_id="+idp+";"+expires+";path=/";
    document.cookie="date="+date+";"+expires+";path=/";
    document.cookie="time="+time+";"+expires+";path=/";
    location.href=<?php echo $base; ?>+ "confirmed.php";


    }
    function mov2(idp,date,time,idd)
    {
      var d = new Date();
    d.setTime(d.getTime() + (24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie="doc_id="+idd+";"+expires+";path=/";
    document.cookie="pa_id="+idp+";"+expires+";path=/";
    document.cookie="date="+date+";"+expires+";path=/";
    document.cookie="time="+time+";"+expires+";path=/";
    location.href=<?php echo $base; ?>+ "cancelled.php";


    }
    </script>
    </div>

  </body>
</html>
