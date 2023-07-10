<?php

$name = $_POST['fullName'];
$email = $_POST['email'];
$dept = $_POST['dept'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];

/*
echo $name;
echo $email;
echo $dept;
echo $password;*/


if (empty($name)){
  die("Name is required");
}
 if (! filter_var($email, FILTER_VALIDATE_EMAIL)){
   die ("Valid email is required");
 }
 if (empty($dept)){
    die("Department is required");
  }
if (strlen($password)<8){
  die("Passsword must be at least 8 characters");
}
if (! preg_match("/[a-z]/i", $password)){
  die("Password must contain at least one letter");
}
if (! preg_match("/[0-9]/", $password)){
  die("Password must contain at least one number");
}
if($password !== $password_confirmation){
  die ("Passwords must match");
}
$password_hash = password_hash($password, PASSWORD_DEFAULT);  // hashing the password for protection

$mysqli = require __DIR__ . "/database.php";    // connecting the database

// insert into the database
  $sql = "INSERT INTO doctor_db (name,dept,email,password_hash)
          VALUES(?,?,?,?)";

  $stmt = $mysqli->stmt_init();
  if(!$stmt -> prepare($sql)){
    die ("SQL error: ".$mysqli->error);
  }

  $stmt->bind_param("ssss", $name, $dept, $email, $password_hash);
  if($stmt->execute()){
        header("Location: doctor_login.php");
        exit;
  }else{
    if($mysqli->errno === 1062){
      die("Email already taken.");
    }else{
      die($mysqli->error. " ". $mysqli->errno);
    }
  }

?>
