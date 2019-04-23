<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
        $base="\"http://localhost/appointments/\""; ?>
    <?php require("/includes/conn.php");
    include_once("/includes/template.php"); ?>
    <script>
      function mov(id)
      {
        var d = new Date();
  d.setTime(d.getTime() + (24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
      document.cookie="doc_id="+id+";"+expires+";path=/";
      var ht=location.href;
console.log(ht);
      var ar=ht.split('/');
      console.log(ar[0]+"//"+ar[2]);
      location.href=<?php echo $base; ?>+ "request1.php";
      }
    </script>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container" style="margin-left:240px;">
      <div class="heading" style="text-align: center; margin-left: -19%; "><h3><span data-feather="plus-circle"></span> Request an Appointment</h3></div>
      <div class="container">
          <div class="row">
              <div class="col-lg-6">
<form class="form-inline" method="post">
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">Search By Doctor</label>
    <input type="text" class="form-control" id="inputPassword2" placeholder="Enter doctorname" name="doc">
  </div>
  <button type="submit" class="btn btn-info mb-2">Search</button>
</form>
              </div>
              <div class="col-lg-6">
          <form class="form-inline" method="post">
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">Search By Speciality</label>
    <input type="text" class="form-control" id="inputPassword2" placeholder="Enter speciality" name="spec">
  </div>
  <button type="submit" class="btn btn-info mb-2">Search</button>
</form>
              </div>
          </div>
          <table class="table table-hover">
<thead>
<tr>
  <th scope="col">Serial No.</th>
  <th scope="col">Doctor Name</th>
  <th scope="col">Hospital</th>
  <th scope="col">Speciality</th>
  <th scope="col">Request an Appointment</th>
</tr>
</thead>
<tbody>

          <?php

         if(isset($_POST['doc']))
         {
             $doctor=$_POST['doc'];
             $quer="Select distinct idd,name,hospital,speciality from doctors where lower(name) like lower('%$doctor%')";
    $rsult=mysqli_query($con,$quer);
    $ount=mysqli_num_rows($rsult);
    if($ount==0)
    {
      echo "<div class='alert alert-warning' role='alert'>No records found!</div>";
    }
    else
    {
      $ser=0;
      while($fetch=mysqli_fetch_assoc($rsult))
      {
        $ser=$ser+1;
        $ev=$fetch['name'];
        $id=$fetch['idd'];
        echo "<tr>";
        echo "<td>".$ser."</td>";
        echo "<td>".$ev."</td>";
        echo "<td>".$fetch['hospital']."</td>";
        echo "<td>".$fetch['speciality']."</td>";
        echo "<td> <button type='button' class='btn btn-primary' onclick='mov(".$id.")'><span data-feather='plus-circle'></span></button></td>";
}
}
         }
  else   if(isset($_POST['spec']))
         {
             $spe=$_POST['spec'];
             $quer="Select idd,name,hospital,speciality from doctors where lower(speciality) like lower('%$spe%')";
    $rslt=mysqli_query($con,$quer);
    $ount=mysqli_num_rows($rslt);
    if($ount==0)
    {
      echo "<div class='alert alert-warning' role='alert'>
  No records found!
</div>";
    }
    else
    {
      $ser=0;
      while($fetch=mysqli_fetch_assoc($rslt))
      {
        $ser=$ser+1;
        $ev=$fetch['name'];
        $id=$fetch['idd'];
        echo "<tr>";
        echo "<td>".$ser."</td>";
        echo "<td>".$ev."</td>";
        echo "<td>".$fetch['hospital']."</td>";
        echo "<td>".$fetch['speciality']."</td>";
        echo "<td> <button type='button' class='btn btn-primary' onclick='mov(".$id.")'><span data-feather='plus-circle'></span></button></td>";
}
}
         }
         else {
           $query="Select idd,name,hospital,speciality from doctors";
           $result=mysqli_query($con,$query);
           $count=mysqli_num_rows($result);
           if($count==0)
           {
             echo "<h1>"."No record Found"."</h1>";
           }
           else
           {

             $ser=0;
             while($fetch=mysqli_fetch_assoc($result))
             {
               $ser=$ser+1;
               $ev=$fetch['name'];
               $id=$fetch['idd'];
               echo "<tr>";
               echo "<td>".$ser."</td>";
               echo "<td>".$ev."</td>";
               echo "<td>".$fetch['hospital']."</td>";
               echo "<td>".$fetch['speciality']."</td>";
               echo "<td> <button type='button' class='btn btn-primary' onclick='mov(".$id.")'><span data-feather='plus-circle'></span></button></td>";
       }
       }
         }
?>
</tbody>
</table>
      <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
      <script>
        feather.replace();
      </script>
    </div>
      </div>
  </body>
</html>
