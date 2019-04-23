<?php require("conn.php"); ?>
<?php
    $base="\"http://localhost/appointments/\"";
    $dono="Select idp,idd,date,time,sent from booking ";
    $reaa=mysqli_query($con,$dono);
    echo time();
    while($swet=mysqli_fetch_assoc($reaa))
    {
      $curtime=time();
      $pieces = explode(" ", $swet['time']);
      $btime=$swet['date']." ".$pieces[0].":00 ".$pieces[1];
      date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)



      $booktime=strtotime($btime);

      $seq=$pieces[1];
      //if($seq=='Pm')
    //  $booktime=$booktime+(12*60*60);

echo "<br>";
echo $booktime-$curtime;
      if(($booktime-$curtime)<=(1800) && $swet['sent']==0)
      {

        $bhejo="Select email from register where idp=".$swet['idp'];
        $pria=mysqli_fetch_assoc(mysqli_query($con,$bhejo));
        $aur="Select name from doctors where idd=".$swet['idd'];
        $metaa=mysqli_fetch_assoc(mysqli_query($con,$aur));
        mail($pria['email'],"Appointment Booking","Your appointment with ".$metaa['name']." has been scheduled dated : ".$swet['date'].
            " at".$swet['time']." You are requested to arrive at the appropriate timings.");
          $vekh="update booking set sent=1 where idp=".$swet['idp']." and idd=".$swet['idd'].
          " and date='".$swet['date']."'";
          $setabai=mysqli_query($con,$vekh);

      }
    }
    ?>
