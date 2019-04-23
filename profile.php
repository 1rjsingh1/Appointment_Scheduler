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
    <div class="container" style="margin-left:240px;">
      <div class="container">
        <center>
        <table id="mytable" class="table table-bordered" style="width:85%;">
    <tr><td colspan="2"><center><h1> Personal Details</h1></center>
    </td>
  </tr>
  <tr></tr>
    <tbody>
    <tr>
      <td>Name of Patient</td>
      <td><?php

      $idd=$_COOKIE["doc_id"];
      $idp=$_SESSION["pid"];
            $quer="Select name,email,mob1,mob2,address,gender,dob,bg from register where idp='$idp'";

            $res=mysqli_query($con,$quer);
            $fetch=mysqli_fetch_assoc($res);


            echo $fetch['name'];

            ?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $fetch['email']; ?></td>
    </tr>
    <tr>
      <td>Mobile No.</td>
      <td><?php echo $fetch['mob1']; ?></td>
    </tr>
    <tr>
      <td>Alternate Mobile No</td>
      <td><?php echo $fetch['mob2']; ?></td>
    </tr>
    <tr>
      <td>Adddress</td>
      <td><?php echo $fetch['address']; ?></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><?php echo $fetch['gender']; ?></td>
    </tr>
    <tr>
      <td>Date Of Birth</td>
      <td><?php echo $fetch['dob']; ?></td>
    </tr>
    <tr>
      <td>Blood Group</td>
      <td><?php echo $fetch['bg']; ?></td>
    </tr>
  </tbody>
</table>
<center><button  type="button" class="btn btn-light"><a style="text-decoration:none" href="home.php"><i class="fa fa-hand-o-left"; aria-hidden="true"; style="font-size:20px; color:'blue';"</i>Back to home page</a></button></center>



    </div>


    </div>

  </body>
</html>
