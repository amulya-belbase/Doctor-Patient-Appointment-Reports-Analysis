<?php 



$is_Invalid = false;


if($_SERVER["REQUEST_METHOD"] === "POST"){
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf("SELECT * FROM doctor_db
                    WHERE email = '%s'",
                    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user){
      if(password_verify($_POST["password"], $user["password_hash"])){
        session_start();
        session_regenerate_id();
        $_SESSION["doctor_id"] = $user["id"];           // declaring session variable for future functionalities
        header("Location: ../services/doctor_dashboard.php");
        exit;
      }
    }
    $is_Invalid = true;
}
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Doctor Login</title>
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
  <!--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="doctor_login.css">
  </head>
  <body>
    <h1 id="header1">Doctor Login</h1>
    <a href="../index.html" class="logo">
      <img src="../assets/images/logo.svg" width="136" height="46" alt="Doclab home">
    </a>
    <figure class="hero-banner" data-reveal="right">
      <img src="../assets/images/hero-banner.png" width="590" height="auto" loading="eager" alt="hero banner"
        class="w-100">
    </figure>

    <?php if($is_Invalid): ?>
    <script>alert('Invalid login!');</script>;
    <?php endif; ?>

    <form method="post" id="form">
      <div id="emailcss">
        <label for="email">Email: </label>
        <input type="email" class="form-control" id="name" name="email"
         value="<?= htmlspecialchars($_POST["email"] ?? "")  ?>">
      </div>
      <div id="passwordcss">
        <label for="password">Password: </label>
        <input type="password" class="form-control" id = "password" name="password">
        <i class="fas fa-eye" onclick="show()"></i>
      </div><br>
     <input type="submit" id = "submit" value="LogIn"/>
     <a href="doctor_signup.php" id="signup">For SignUp</a>
        <br>
     <a href="login.php" id="userlogin">For User Login</a>
    </form>
    <script>
      function show(){
        var password = document.getElementById("password");
        var icon = document.querySelector(".fas")

        // ========== Checking type of password ===========
        if(password.type === "password"){
          password.type = "text";
        }
        else {
          password.type = "password";
        }
      };
    </script>
  </body>
</html>















