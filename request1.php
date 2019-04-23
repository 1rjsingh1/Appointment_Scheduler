<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require("/includes/conn.php");
    include_once("/includes/template.php");
    ?>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container" style="margin-left:240px;">
      <div class="heading" style="text-align: center; "><h3><span data-feather="plus-circle"></span> Request an Appointment</h3></div>
      <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
      <script>
        feather.replace()
      </script>

      <div class="container">
        <div class="row" style="border-bottom:1px solid grey; margin-right:100px;">
          <h5 style="text-align:left;">
            <?php
            $event=$_COOKIE["doc_id"];
            $query="Select name,speciality from doctors where idd=".$event;
            $result=mysqli_query($con,$query);
            $fetch=mysqli_fetch_assoc($result);
            echo $fetch['name'];


              ?>
              &nbsp (Speciality - <?php echo $fetch['speciality']; ?>)
</h5>
</div> <br>
        <div class="row">

          <div class="col-lg-6">
            <p style="border:2px solid rgb(0, 179, 0); padding:5px 5px 5px 5px;"> Days Aavailable - &nbsp
            <?php
            $event=$_COOKIE["doc_id"];
            $query="Select day from daysavail where idd=".$event;
            $result=mysqli_query($con,$query);
            while($fetch=mysqli_fetch_assoc($result))
            {
              echo $fetch['day']." ";
            }
            ?>

                            </p>
          </div>
          <div class="col-lg-6">
            <p style="border:2px solid rgb(0, 179, 0); padding:5px 5px 5px 5px;"> Timing Slots - &nbsp
            <?php
            $event=$_COOKIE["doc_id"];
            $query="Select time from timeavail where idd=".$event;
            $result=mysqli_query($con,$query);
            while($fetch=mysqli_fetch_assoc($result))
            {
              echo $fetch['time']." ";
            }
            ?>

                            </p>
          </div>


        </div>

        <form method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="col-lg-6">
      <label for="validationDefault01">Select Date</label>
      <input type="date" name="date" class="form-control" id="validationDefault01" placeholder="First name" value="Mark" required>
    </div>
    <div class="col-lg-6">
      <label for="validationDefault02">Time</label>
      <select required class="custom-select" id="validationDefault02" name="time">
        <option selected>----------</option>
        <?php
        $event=$_COOKIE["doc_id"];
        $query="Select time from timeavail where idd=".$event;
        $result=mysqli_query($con,$query);
        while($fetch=mysqli_fetch_assoc($result))
        {
          echo "<option value='".$fetch['time']."'>".$fetch['time']."</option>";
        }
        ?>
      </select>
     </div>


  </div>
  <br>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Problem Description</label>
    <textarea class="form-control" name="descp" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <center>
   <button class="btn btn-primary" name="final5" type="submit">Submit Request</button>
 </center>
</form>
<?php
if(isset($_POST['final5']))
{

  $dat=$_POST['date'];
          $tim=$_POST['time'];
 $f=1;
 $dat2=$dat;
 $tim2=$tim;
 $dat2=$dat2." ".$tim2;

 $dat3=strtotime($dat2);


 if(time()>$dat3)
 {
     $f=0;

          echo "<script> alert('Please choose correct date and time!');
          </script>";

 }

$f2=1;
          $query="SELECT * FROM booking WHERE date='$dat' and time='$tim'";
    $result=mysqli_query($con,$query);
 $count = mysqli_num_rows($result);
 $fet=mysqli_fetch_assoc($result);
 if($count>0)
    {  $f2=0;
          echo"<script> alert('Time slot already booked! Please try another one!');</script>";

    }
date_default_timezone_set("Asia/Calcutta");
 $weekday = date('l', $dat3);

            $quer="Select * from daysavail where idd='$event' and day='$weekday' ";

            $reslt=mysqli_query($con,$quer);
           $count4 = mysqli_num_rows($reslt);
 $f3=1;
 if($count4==0)
 {
     $f3=0;
      echo"<script> alert('Kindly select from the available days! ');</script>";
 }


   if($f && $f2 && $f3)
   {

$pid=$_SESSION['pid'];
  extract($_POST);
  $_SESSION["cdate"]=$_POST['date'];
    $quer1="Insert into booking(idp,idd,date,time,descpt) values(".$pid.",".$event.",'
  ".$_POST['date']."',\"".$_POST['time']."\",
  \"".$_POST['descp']."\")";
  echo $quer1;
  $count2=mysqli_query($con,$quer1);

if($count2)
{
  $qq="Select email from register where idp='$pid'";
  $exe=mysqli_query($con,$qq);
  $res=mysqli_fetch_assoc($exe);
  $qq1="Select name from doctors where idd='$event'";
  $exe1=mysqli_query($con,$qq1);
  $res1=mysqli_fetch_assoc($exe1);
  mail($res['email'],"Appointment Booking","Your appointment with ".$res1['name']." has been scheduled dated : ".$_POST['date'].
      " at".$_POST['time'].". You are requested to arrive at the appropriate timings.");

echo "<script>location.href='http://localhost/appointments/request2.php';</script>";
}
else {
  echo "<div class='alert alert-primary' role='alert'>
Your request failed Plz Try again!
</div>";
}

}
}
 ?>
      </div>

    </div>

  </body>
</html>
