<?php
    include ("includes\conn.php");
    $idd=$_COOKIE['doc_id'];
      $idp=$_COOKIE['pa_id'];
        $date=$_COOKIE['date'];
        $time=$_COOKIE['time'];
        $quee="Select register.email,doctors.name dname,register.name pname,time from booking,doctors,register
        where booking.idd=doctors.idd and booking.idp=register.idp and booking.idp='$idp' AND
        booking.idd='$idd' and booking.date='$date' and booking.time='$time'";

        $res=mysqli_fetch_assoc(mysqli_query($con,$quee));
        mail($res['email'],"Appointment Booking","Your appointment with ".$res['dname']." has been Canaceled dated : ".$date.
            " at".$res['time'].". You are requested to reschedule at any other available slot.");

            $vekh="update booking set confirm=1 where idp=".$idp." and idd=".$idd.
            " and date='".$date."'";
            $setabai=mysqli_query($con,$vekh);
header("Location:dochome.php");
    ?>
