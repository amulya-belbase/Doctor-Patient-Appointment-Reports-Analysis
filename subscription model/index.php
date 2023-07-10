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
    }}else{
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
        <title>Monthly Subscription</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
          rel="stylesheet">
          <link rel="stylesheet" href="style.css" />
      </head>
      <body>
        <div id="card">
          <div id="top-section">
            <h1>Hi, <?php echo $name ?></h1>
           <h2>Join Our Community</h2>
           <h3>Medical assistance at a push of a button</h3>
           <p>Our system will provide you with full assistance for all your medical needs.
             Curated by the experts in their respective field, you won't have any trouble whatsoever.
           </p>
          </div>
         <div id="bottom-section">
          <div id="bottom-left-section">
            <h3>Our Monthly Subscription</h3>
             <div id="price-container">
                 <div id="price">$29</div>
                 <div id="price-rate">per month</div>
             </div>
             <p>Full access for less than $1 a day.</p>
             <p>Online reports and many more</p>
             <button onclick="location.href='./subs.php?id=<?php echo $id;?>&name=<?php echo $name;?>';">Subscribe</button>
           </div><div id="bottom-right-section">
            <h3>Why Us?</h3>
              <ul>
                <li>We have a myriad of options for all your medical needs.</li>
                <li>Few clicks away from booking your doctor's appointment.</li>
                <li>Experts maintaining the system 24x7.</li>
                <li>Online consultation.</li>
                <li>Online medical reports.</li>
                <li>At home tests.</li>
              </ul>
          </div>
         </div>
       </div>
       <script src="subs.js"></script>
      </body>
    </html>
