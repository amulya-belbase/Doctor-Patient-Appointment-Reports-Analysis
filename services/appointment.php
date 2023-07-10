<?php include "function.php";
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
    }}?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Appointments</title>
    <link rel="stylesheet" href="appointment.css"/>
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
          <h1>Appointments</h1>
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
        <form action="filter.php" method="post">
        <div class="filters">
          <span class="words">Filter By Department:</span>
          <select class="fetch" name="department" id="bydept">
            <option value="all" selected=""> All</option>
            <option value="Cardiology">Cardiology</option>
            <option value="Nephrology">Nephrology</option>
            <option value="Oncology">Oncology</option>
            <option value="Orthopedics">Orthopedics</option>
          </select>
          <span class="words">Filter By Gender:</span>
          <select class="gendertype" name="gendertype" id="bygen">
            <option value="all" selected="">All</option>
            <option value="m">Male</option>
            <option value="f">Female</option>
          </select>

            <input type = "submit" value = "Submit" id="sub">

        </div>
      </form>
  <section class="doctor">
    <div class="doctor-list">
      <h1>Doctors List</h1>
        <table class="table" id="targetTable">
          <thead>
            <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Hospital</th>
            <th>Experience</th>
            <th>Appointment</th>
            </tr>
          </thead>
          <?php
             $list = getAllDoctors();
             foreach ($list as $doctors) {
             ?>
               <tbody>
                 <tr onclick="bookdoc(this)">
                   <td><?php echo $doctors['name']?></td>
                   <td><?php echo $doctors['gender']?></td>
                   <td><?php echo $doctors['department']?></td>
                   <td><?php echo $doctors['hospital']?></td>
                   <td><?php echo $doctors['experience']?> Years</td>
                   <td><input type="button" class ="button" onclick="location.href='#divOne';" value="Book" /></td>
                 </tr>
               </tbody>
             <?php
             }
          ?>
        </table>
    </div>
  </section>
</section>
</div>
<div class="overlay" id="divOne">
  <div class="wrapper">
      <h2>Book Your Appointment</h2>
      <a href="#" class="close">&times;</a>
      <div class="content">
        <div class="container">
          <form action="book_appointment.php" method="post"> <!-- from here we can make php connection -->
              <label>Patient's Name</label>
              <input type="text" name="pname" placeholder="Your Name">
              <label>Doctor's Name</label>
              <input type="text" name="dname" placeholder="Doctor Name" readonly id="docname">
              <label>Department</label>
              <input type="text" name="department" placeholder="Department" readonly id="departmentname">
              <label>Contact No.</label>
              <input type="text" name="contact" placeholder="Contact No." id="contact">
              <label for="birthday">Appointment Date:</label>
              <input type="date" id="appointment" name="appointment">
              <br>
              <label>Your symptoms:</label>
              <textarea name="sympd" placeholder="Your Symptoms Here..."></textarea>
              <input type="submit" value="submit" id="formsub">
          </form>
        </div>
      </div>
  </div>
</div>
<script src="book_doc.js"> </script>
</body>
</html>
