<?php
      include "../signup/database.php";
session_start();
if (isset($_SESSION["user_id"])){
$id = $_SESSION["user_id"];
$forname = "SELECT * FROM user
                WHERE id = '$id'";
$result = mysqli_query($mysqli,$forname); // passing the sql code through conn into the database
$user = $result->fetch_assoc();
if ($user){
      $name = $user['name'];
      $email = $user['email'];
    }

  }else{
      ?><script>
        alert("You haven't logged in!!");
        window.location.href = "../signup/login.php";
      </script>
  <?php }
   ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Settings</title>
    <link rel="stylesheet" href="settings.css"/>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>  <!-- external js validation -->
    <script src ="./update_validation.js" defer></script>   <!-- internal js validation-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
      rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <nav>
        <ul>
          <li><a href="../index2.html" class="logo">
              <img src="../assets/images/logo.svg" alt="Doclab home">
            </a></li>
          <li><a href="./dashboard.php">
              <i class="fas fa-menorah"></i>
              <span class="nav-item">Dashboard</span>
          </a></li>
          <li><a href="./appointment.php">
              <i class="fas fa-comment"></i>
              <span class="nav-item">Appointment</span>
          </a></li>
          <li><a href="./reports.php">
              <i class="fas fa-database"></i>
              <span class="nav-item">Reports</span>
          </a></li>
          <li><a href="./analytics.php">
              <i class="fas fa-chart-bar"></i>
              <span class="nav-item">Analytics</span>
          </a></li>
          <li><a href="./settings.php">
              <i class="fas fa-cog"></i>
              <span class="nav-item">Settings</span>
          </a></li>
          <li><a href="../signup/logout.php" class="logout">
              <i class="fas fa-sign-out-alt"></i>
              <span class="nav-item">Log Out</span>
          </a></li>
        </ul>
      </nav>
          <section class="main">
            <div class="main-top">
              <h2 id="line">User Settings</h2>
              <div class="apponicon">
               <?php if (isset($id)){?><p class="forlogin">Welcome, <?php echo $name;?>
                 <ul>
                   <li><a href="my_appointments.php" id ="aphref">My appointments</a></li>
                 </ul></p>
               <?php }else{
                 ?><i class="fas fa-user-cog">
                   </i><?php
               } ?>
              </div>
            </div>

          <div class="userdetails">
            <div class="updateinput">
              <form action="userupdate.php" method="post" id="updaterecord" novalidate>
                <div class="inputBox">
                  <label>User Name: </label>
                  <input type="text" name="name" id="name" value = <?php var_export($name); ?>>
                </div>
                <div class="inputBox">
                  <label>Your Email: </label>
                  <input type="text" name="email" id="email" value = <?php echo $email; ?>>
                </div>
                <div class="inputBox">
                  <label>Old Password: </label>
                  <input type="password" name="oldpassword" id="oldpassword">
                </div>
                <div class="inputBox">
                  <label>New Password: </label>
                  <input type="password" name="newpassword" id="newpassword">
                </div>
                <div class="inputBox">
                  <label>Confirm New Password: </label>
                  <input type="password" id="confirmpassword" name="confirmpassword">
                </div>
                <i class="fas fa-eye" id="eye" onclick="show()"></i>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" required>
                  <input type="submit" value="Update" id="formsub">
              </form>
            </div>
          </div>
  </section>
    </div>
    <script>
      function show(){
        var oldpassword = document.getElementById("oldpassword");
        var newpassword = document.getElementById("newpassword");
        var confirmpassword = document.getElementById("confirmpassword");
        var icon = document.querySelector(".fas")

        // ========== Checking type of password ===========
        if(oldpassword.type === "password" && newpassword.type === "password" && confirmpassword.type === "password" ){
          oldpassword.type = "text";
          newpassword.type = "text";
          confirmpassword.type = "text";
        }
        else {
          oldpassword.type = "password";
          newpassword.type = "password";
          confirmpassword.type = "password";
        }
      };
    </script>
</body>
</html>
