<?php
   session_start();
   $host = "localhost";
   $user = "root";
   $password = "";
   $db_name = "ramhealth";
   
   $con = mysqli_connect($host , $user , $password , $db_name) 
   or 
   die("Failed to connect with MySQL: " . mysqli_connect_error());
?>