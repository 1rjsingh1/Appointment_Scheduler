<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
        $base="\"http://localhost/appointments/\""; ?>
    <script type="text/javascript" >


    function mov1(id,date)
    {
      var d = new Date();
    d.setTime(d.getTime() + (24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie="doc_id="+id+";"+expires+";path=/";
    location.href=<?php echo $base; ?>+ "set.php?date="+date;


    }
    </script>
    <?php require("/includes/conn.php");
    include_once("/includes/template.php"); ?>
    <meta charset="utf-8">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title></title>
  </head>
  <body>
      <div class="container" style="margin-left:16%;">
        <div class="heading" style="text-align: center; "><h3><span data-feather="plus-circle"></span> Upcoming Appointments</h3></div>

      <?php
      $idp=$_SESSION['pid'];
      $c=time();
      //India time (GMT+5:30)




      $query="Select doctors.name dname,booking.idd,hospital,date,time,descpt from booking,doctors where
     booking.idp=".$idp." and doctors.idd=booking.idd";

    $result=mysqli_query($con,$query);
    $count=mysqli_num_rows($result);
    if($count==0)
    {
      echo "<h1>"."No record Found"."</h1>";
    }
    else
    {


$count=mysqli_num_rows($result);
    echo "<table class='table table-hover'>
  <thead class='thead-dark' >
    <tr>

      <th scope='col'>DOCTOR NAME</th>
      <th scope='col'>HOSPITAL</th>
      <th scope='col'>DATE</th>
      <th scope='col'>TIME</th>
      <th scope='col'>DESCRIPTION</th>
      <th scope='col'>GENERATE REPORT</th>
    </tr>
  </thead>
  <tbody>";
 if($count>0){

  while($fetch=mysqli_fetch_assoc($result)){
    $piecea = explode(" ", $fetch['time']);
    $btimea=$fetch['date']." ".$piecea[0].":00 ".$piecea[1];
    date_default_timezone_set("Asia/Calcutta");
    $booktimea=strtotime($btimea);
    if($booktimea>$c)
    {
			echo "<tr>";

echo "<td>" .$fetch['dname'] . "</td>";
echo "<td>" .$fetch['hospital'] . "</td>";
 echo "<td>" .$fetch['date'] . "</td>";
      echo "<td>" .$fetch['time']. "</td>";
      echo "<td>" .$fetch['descpt']."</td>";
      echo "<td><button class='btn btn light' onclick='mov1(".$fetch['idd'].",\"".$fetch['date']."\")' ><i class='fas fa-file-excel' style='color:green'; font-size:20px;'</i></button></td>";


echo "</tr>";

}}

    echo "</tbody>
</table>
    ";
}
    }

?>
      </div>
  </body>
</html>
