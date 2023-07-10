<?php
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$oldpassword = $_POST['oldpassword'];
$password = $_POST['newpassword'];
$password_confirmation = $_POST['confirmpassword'];
/*
echo $id;
echo $name;
echo $email;
echo $oldpassword;
echo $password;
echo $password_confirmation;*/

session_start();
if (isset($_SESSION["user_id"])){
  if($_SERVER["REQUEST_METHOD"] === "POST"){
    $mysqli = include "../signup/database.php";
    $sql = sprintf("SELECT * FROM user
                    WHERE id = '%s'",
                    $mysqli->real_escape_string($id));

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user){
      if(password_verify($oldpassword, $user["password_hash"])){
        if (empty($name)){
          die("Name is required");
        }
         if (! filter_var($email, FILTER_VALIDATE_EMAIL)){
           die ("Valid email is required");
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
        //echo $password_hash;
          $mysqli = include "../signup/database.php";  // connecting the database
        // insert into the database
          $sql = "UPDATE user SET name ='$name', email ='$email', password_hash = '$password_hash'
                  WHERE id = $id";

          $stmt = $mysqli->stmt_init();
          if(!$stmt -> prepare($sql)){
            die ("SQL error: ".$mysqli->error);
          }

          $stmt->bind_param("sss", $name, $email, $password_hash);
          if($stmt->execute()){
                ?><script>
                  alert ("Update Successful. Login with your new credentials");
                  window.location.href ="../signup/logout.php";
                </script><?php
          }else{
            if($mysqli->errno === 1062){
              ?><script>alert("Email already taken.");
                        window.location.href = "./settings.php";
              </script><?php
              die();
            }else{
              die($mysqli->error. " ". $mysqli->errno);
            }
          }

      }else{
        ?> <script>
          alert("Old password is wrong");
          window.location.href="./settings.php";
        </script><?php
      }
    }}}else{
        ?><script>
          alert("You haven't logged in!!");
          window.location.href = "../signup/login.php";
        </script>
    <?php }
     ?>
