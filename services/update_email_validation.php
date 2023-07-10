<?php
  $mysqli = include "../signup/database.php";
  $jsemail = $_GET['email'];
  $sql = sprintf("SELECT * FROM user
                  WHERE email = '%s'",
                  $mysqli->real_escape_string($_GET["email"]));
  $result = $mysqli -> query($sql);
  $aresult = $mysqli -> query($sql);
  $rowcount=mysqli_num_rows($aresult);
  $user = $result->fetch_assoc();
  if($user){
      $dbemail = $user['email'];
  }
  if($rowcount == 0 OR $dbemail == $jsemail){
    $is_available = true;
  header ("Content-Type: application/json");
  echo json_encode(["available" => $is_available]);}
