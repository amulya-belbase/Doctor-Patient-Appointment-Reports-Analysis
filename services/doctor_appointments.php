<?php 

 include "function.php";
 include "../signup/database.php";
 include "./dbconn.php";

session_start();
if (isset($_SESSION["doctor_id"])){
$id = $_SESSION["doctor_id"];
$forname = "SELECT * FROM doctor_db
                WHERE id = '$id'";
$result = mysqli_query($mysqli,$forname); // passing the sql code through conn into the database
$user = $result->fetch_assoc();
if ($user){
      $name = $user['name'];
      $department = $user['dept'];
    }}?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="doctor_appointments.css"/>
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
          <li><a href="./doctor_dashboard.php">
              <i class="fas fa-menorah"></i>
              <span class="nav-item">Dashboard</span>
          </a></li>
          <li><a href="./doctor_appointments.php">
              <i class="fas fa-database"></i>
              <span class="nav-item">My Appointments</span>
          </a></li>
          
          <li><a href="../signup/doctor_logout.php" class="logout">
              <i class="fas fa-sign-out-alt"></i>
              <span class="nav-item">Log Out</span>
          </a></li>
        </ul>
      </nav>
      <section class="main">
        <div class="main-top">
          <h1>My Appointments</h1>
          <div class="docname">
           <?php if (isset($id)){?><p class="forlogin">Welcome, <?php echo "Dr. ".$name;?>
           <?php }else{
             ?><i class="fas fa-user-cog">
               </i><?php
           } ?>
          </div>
        </div>
        <div class="users">
          <?php
                $rows = "SELECT * FROM booking_records WHERE department ='$department' AND dname = '$name'";
                $count = mysqli_query($conn,$rows);
                $rowcount=mysqli_num_rows($count);

                $sql = "SELECT * FROM booking_records WHERE department ='$department'AND dname = '$name'";
                $result = mysqli_query($conn,$sql); // passing the sql code through conn into the database, to get displaying results
                

                $aresult = mysqli_query($conn,$sql);  // using 2 queries because empty() function will fetch the first set of array for if statement
                $sameDoctors = $aresult->fetch_assoc();

                

                if (empty($sameDoctors['id'])){              // compare just the id section of the assosiative array, if empty, no data
                    ?>
                        <div id="noapp">
                            <p> You don't have any appointments  </p>
                        </div>
                    <?php
                  }else{
                    $i = 0;
                    for ($i; $i<$rowcount;$i++){
                            echo '<div class="card">'  ?>
                            <?php

                             while(($user = $result->fetch_assoc()) != false){   // until assosiative array is empty (false)
                                $j=0;
                               $name = $user['pname'];
                               $doctor = $user['dname'];
                               $dept = $user['department'];
                               $sympd = $user['sympd'];
                               $appoint = $user['appointment'];

                 ?>
                
                             <img src="2.png">
                             <h3>Patients's Name: <?php echo $name;?> </h3>
                             <h4>Doctor: <?php echo $doctor;?></h4>
                             <h4>Department: <?php echo $dept;?></h4>
                             <h4>Symptoms: <?php echo $sympd;?></h4>
                             <h4>Appointment Date: </h4>
                             <div class="per">
                                 <table>
                                   <tr>
                                     <td><span><?php echo $appoint; ?></span></td>
                                   </tr>
                                 </table>
                             </div>
                           </div>
                           <?php
                            $j++;
                            if($j == 1){

                              break;
                                    }

                        }  } }?>

                    


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
<script src="book_doc.js"> </script>
</body>
</html>

