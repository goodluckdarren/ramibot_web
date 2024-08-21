<?php
   // Check if session has started
   if (session_status() == PHP_SESSION_NONE) {
      session_start();
   }
   $host = "localhost";
   $user = "root";
   $password = "";
   $db_name = "ramibot";
   // if (session_status() == PHP_SESSION_NONE) {
   //    session_start();
   // }
   // $host = "airhub-soe.apc.edu.ph";
   // $user = "marj";
   // $password = "RAMIcpe211";
   // $db_name = "ramibot";
   
   // $con = mysqli_connect($host , $user , $password , $db_name) 
   // or 
   // die("Failed to connect with MySQL: " . mysqli_connect_error());

   // $host = "localhost";
   // $user = "root";
   // $password = "";
   // $db_name = "ramibot";
   
   $con = mysqli_connect($host , $user , $password , $db_name) 
   or 
   die("Failed to connect with MySQL: " . mysqli_connect_error());

?>
