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
      <div class="heading" style="text-align: center; "><h3><span data-feather="plus-circle"></span> Request an Appointment</h3></div>

      <div class="container">


<table class="table table-hover">
<thead>
<tr>
  <th scope="col">Serial No.</th>
  <th scope="col">Doctor Name</th>
  <th scope="col">Speciality</th>
  <th scope="col">Request an Appointment</th>





</tr>
</thead>
<tbody>
<?php

    $query="Select idd,name,speciality from doctors";
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
        echo "<td>".$fetch['speciality']."</td>";
        echo "<td> <button type='button' class='btn btn-primary' onclick='mov(".$id.")'><span data-feather='plus-circle'></span></button></td>";
}
}
?>
</tbody>
</table>

      <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
      <script>
        feather.replace()
      </script>

    </div>

  </body>
</html>
