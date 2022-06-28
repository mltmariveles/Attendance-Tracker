<?php
 
 $con = mysqli_connect("localhost", "root", "","dbworkbank");

 // Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>