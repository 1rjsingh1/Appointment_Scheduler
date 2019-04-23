<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require("/includes/conn.php");
    include_once("/includes/template.php"); ?>
    <meta charset="utf-8">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title></title>
  </head>
  <body>
      <div class="container" style="margin-left:16%;">
      <?php
      $idp=$_SESSION['pid'];
      $query="Select doctors.name dname,booking.idd,date,hospital,time,descpt from booking,doctors where
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
      <th scope='col'>CANCEL APPOINTMENT</th>
    </tr>
  </thead>
  <tbody>";
 if($count>0){

  while($fetch=mysqli_fetch_assoc($result)){
			echo "<tr>";

echo "<td>" .$fetch['dname'] . "</td>";
echo "<td>" .$fetch['hospital'] . "</td>";
 echo "<td>" .$fetch['date'] . "</td>";
      echo "<td>" .$fetch['time']. "</td>";
      echo "<td>" .$fetch['descpt']."</td>";
      echo "<td><button class='btn btn light'><a onClick=\"javascript: return confirm('Please confirm deletion');\" href='delete2.php?id=".$fetch['idd']."&date=".$fetch['date']."'><i class='fas fa-trash-alt' style='color:red'; font-size:20px;'</i></a></button></td>";
echo "</tr>";

    }

    echo "</tbody>
</table>
    ";
}
    }

?>
      </div>
  </body>
</html>
