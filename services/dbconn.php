<?php
    $host = "localhost";
    $user ="root";
    $pass = "";
    $dbname = "doctor";

    $conn = mysqli_connect($host,$user,$pass,$dbname) or die();
  /*   if($conn->connect_errno){
       die("Connection error: ".$conn->connect_error);
     }
     return $conn;*/
 ?>
