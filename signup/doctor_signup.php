<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>  <!-- external js validation -->
    <script src ="./js/validation.js" defer></script>   <!-- internal js validation-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
      rel="stylesheet">
    <link rel="stylesheet" href="doctor_signup.css">
  </head>
  <body>
    <h1 id="header1">SignUp</h1>

    <a href="../index.html" class="logo">
      <img src="../assets/images/logo.svg" width="136" height="46" alt="Doclab home">
    </a>
    <figure class="hero-banner" data-reveal="right">
      <img src="../assets/images/hero-banner.png" width="590" height="auto" loading="eager" alt="hero banner"
        class="w-100">
    </figure>

    <form action="doctor_connect.php" method="post" id="signup" novalidate>
      <div id="namecss">
        <label for="name">Name: </label>
        <input type="text" class="form-control" id="name" name="fullName">
      </div>
      <div id="emailcss">
        <label for="email">E-mail: </label>
        <input type="email" class="form-control" id = "email" name="email">
      </div>
      <div id="deptcss">
        <label for="department">Department: </label>
        <input type="text" class="form-control" id = "dept" name="dept">
      </div>
      <div id="passwordcss">
        <label for="password">Password: </label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div id="passwordconfirmcss">
        <label for="password_confirmation">Repeat Password: </label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
      </div>
      <i class="fas fa-eye" onclick="show()"></i><br>
       <button>SignUp</button><br>
        <a href="doctor_login.php" id="login">For LogIn</a>

        <!--<input type="submit" id = "submit" value = "SignUp"/>
    -->
  </form>
  <script>
    function show(){
      var password = document.getElementById("password");
      var password_confirm = document.getElementById("password_confirmation");
      var icon = document.querySelector(".fas")

      // ========== Checking type of password ===========
      if(password.type === "password" && password_confirmation.type === "password"){
        password.type = "text";
        password_confirmation.type = "text";
      }
      else {
        password.type = "password";
        password_confirmation.type = "password";
      }
    };
  </script>
  </body>
</html>
