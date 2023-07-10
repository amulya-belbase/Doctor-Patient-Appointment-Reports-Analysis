<?php include "function.php";
include "../signup/database.php";

include 'dbconn.php';

session_start();

$id = $_SESSION["user_id"];


// echo "Patient's Name: ".$pname."Doctor's name: ".$dname."Appointment Date: ".$appointment."Symptoms: ".$sympd;

if (isset($id)){

  // this is to get the name of the user
  $forname = "SELECT * FROM user
                  WHERE id = '$id'";
  $queryName = mysqli_query($mysqli,$forname); // passing the sql code through conn into the database
  $userName = $queryName->fetch_assoc();
  if ($userName){
        $name = $userName['name'];
      }


// This is for counting the number of rows, to display in my_appointments page
    $rows = "SELECT * FROM booking_records WHERE user_id ='$id'";
    $count = mysqli_query($conn,$rows);
    $rowcount=mysqli_num_rows($count);


// continuation of main sql query
    $sql = "SELECT * FROM booking_records WHERE user_id ='$id'";
    $result = mysqli_query($conn,$sql); // passing the sql code through conn into the database, to get displaying results
    $aresult = mysqli_query($conn,$sql);  // using 2 queries because empty() function will fetch the first set of array for if statement
    $userAppointments = $aresult->fetch_assoc();
    if (empty($userAppointments['user_id'])){              // compare just the id section of the assosiative array, if empty, no data
      ?>
        <script>
          alert("You haven't booked an appointment !!");
          window.location.href = "appointment.php";
        </script>
      <?php
    }else{

}}

else{
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
    <title>My Appointments</title>
    <link rel="stylesheet" href="my_appointment.css"/>
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
          <h1>My Appointments</h1>
          <div class="apponicon">
            <?php if (isset($id)){?><p class="forlogin">Welcome, <?php echo $name;}?>
          </div>

        </div>
        <div class="users">

                <?php
                          $j = 0;
                          for($j; $j<$rowcount; $j++){
                            echo '<div class="card">'  ?>


                            <?php

                             while(($user = $result->fetch_assoc()) != false){   // until assosiative array is empty (false)
                                $i=0;
                               $appno = $user['id'];
                               $pname = $user['pname'];
                               $dname = $user['dname'];
                               $appointment = $user['appointment'];
                               $contact = $user['contact'];
                 ?>

                             <img src="2.png">
                             <p>Appointment No. <?php echo $appno;?> </p>
                             <h4>Patient's Name: <?php echo $pname;?></h4>
                             <p>Doctor's Name: <?php echo $dname;?></p>
                             <p>Contact No.: <?php echo $contact;?></p>
                             <p>Appointment Date: </p>
                             <div class="per">
                                 <table>
                                   <tr>
                                     <td><span><?php echo $appointment; ?></span></td>
                                   </tr>
                                 </table>
                             </div>

                           <button onclick="location.href='./update_record.php?id=<?php echo $appno;?>';">Update</button>


                           <button onclick="location.href='./delete_record.php?id=<?php echo $appno;?>';">Delete</button>

                           </div>

                           <?php
                            $i++;
                            if($i == 1){

                              break;
                                    }

                        }   }?>



  </div>




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
          <form action="book_appointment.php" method="post" id="popup"> <!-- from here we can make php connection -->
              <label>Patient's Name</label>
              <input type="text" name="pname" placeholder="Your Name">
              <label>Doctor's Name</label>
              <input type="text" name="dname" readonly placeholder="Doctor Name" id="docname">
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
