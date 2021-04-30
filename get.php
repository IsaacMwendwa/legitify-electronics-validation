<?php
   $connect = mysqli_connect("localhost","isaka","tugoslav","legitify");
   if(! $connect ) {
      die('Could not connect: ' . mysqli_error());
   }
   $sql = "SELECT distinct modelName FROM serials";

   $retval = mysqli_query( $connect, $sql );
   
   if(! $retval ) {
   	echo $retval;
      die('Could not get data: ' . mysqli_error());
   }
   
   while($row = mysqli_fetch_array($retval, MYSQL_ASSOC)){
      echo "Model Name :{$row['modelName']}  <br> ";
   }
   mysqli_close($conn);
?>