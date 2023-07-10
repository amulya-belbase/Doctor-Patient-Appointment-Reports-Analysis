<?php
  include "../signup/database.php";

  function connect(){
        $host = "localhost";
        $user ="root";
        $pass = "";
        $dbname = "doctor";

        $mysqli = new mysqli($host,$user,$pass,$dbname);
         if($mysqli->connect_errno){
           die("Connection error: ".$mysqli->connect_error);
         }
         return $mysqli;
  }

  function getAllDoctors(){
    $mysqli = connect();
    $res = $mysqli->query("SELECT * FROM doctor_list ORDER BY RAND()");
    while($row=$res->fetch_assoc()){
      $doctors[]=$row;
    }
    return $doctors;
  }


?>
