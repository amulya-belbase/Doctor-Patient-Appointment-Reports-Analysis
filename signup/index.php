<?php

session_start();

if (isset($_SESSION["user_id"])){
  $mysqli = require __DIR__ ."/database.php";
  $sql = "SELECT * FROM user
          WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  </head>
  <body>
    <h1>Home</h1>
    <?php if(isset($user)): ?>
        <p>Hello <?= htmlspecialchars($user["name"]) ?>. You are logged in.</p>
        <p><a href="logout.php">LogOut</a></p>
    <?php else: ?>
      <p><a href="login.php">LogIn</a> Or <a href="signup.html">SignUp</a></p>
    <?php endif; ?>
</body>
</html>
