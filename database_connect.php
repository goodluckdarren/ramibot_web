<?php
   session_start();
   $host = "airhub-soe.apc.edu.ph";
   $user = "marj";
   $password = "RAMIcpe211";
   $db_name = "ramibot";
   
   $con = mysqli_connect($host , $user , $password , $db_name) 
   or 
   die("Failed to connect with MySQL: " . mysqli_connect_error());
?>