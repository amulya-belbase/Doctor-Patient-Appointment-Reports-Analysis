<?php include "function.php";
      include "../signup/database.php";
      include "dbconn.php";

session_start();                        // to see if the user is logged in or not
if (isset($_SESSION["user_id"])){
$id = $_SESSION["user_id"];

// to get the number of row of the appointments by that user
$rows = "SELECT * FROM booking_records WHERE user_id ='$id'";
$count = mysqli_query($conn,$rows);
$rowcount=mysqli_num_rows($count);


// to get the username
$uname = "SELECT * FROM user
                WHERE id = '$id'";
$aresult = mysqli_query($mysqli,$uname); // passing the sql code through conn into the database
$auser = $aresult->fetch_assoc();
if ($user){
      $name = $auser['name'];
    }
$isValid = false;

// for subscription validity
$check_subs = "SELECT * FROM subscription WHERE user_id='$id'";
$result_subs = mysqli_query($conn,$check_subs);
$check_subs_validity = $result_subs->fetch_assoc();
if(isset($check_subs_validity['user_id'])){
  $for_subs_validity = "SELECT subsdate FROM subscription WHERE user_id='$id'";
  $for_subs_validity_result = mysqli_query($conn,$for_subs_validity);
  $for_subs_validity_date = $for_subs_validity_result->fetch_assoc();
  if($for_subs_validity_date){
    $date = $for_subs_validity_date['subsdate'];

      date_default_timezone_set('Asia/Shanghai');
      $currentdate = date('Y-m-d H:i:s');
      // Creates DateTime objects
      $datetime1 = date_create($currentdate);

      $for_date_diff = date('Y-m-d', strtotime($date. ' + 30 days'));   // add 30 days to the subs date
    //echo $for_date_diff;
      $validate = date_create($for_date_diff);

      if($datetime1<$validate){
        $isValid = true;
      }else{
        $isValid = false;
      }

      $fordisplay = date_diff($datetime1, $validate);
      // turning the difference into numerical difference
      $see= $fordisplay->format('%d');
  //  echo $see;
  }}





// main sql query to get the doctor's name
$forname = "SELECT * FROM booking_records
                WHERE user_id = '$id'";
$result = mysqli_query($conn,$forname); // passing the sql code through conn into the database

$i = 0;
while(($user = $result->fetch_assoc()) != false){   // until assosiative array is empty (false)
$department[] = $user['department'];        // store dname in an array
$dname[]=$user['dname'];
$i++;
if($i>=$rowcount){      // if i equals to rowcount or greater, break from the loop
  break;
}}

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
         <title>My Reports</title>
         <link rel="stylesheet" href="reports.css"/>
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
               <h1 id="line">Based on your appointments, following fields are suggested.</h1>

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
             <div class="users">


               <?php
               // to fetch the doctor's name and speciality from the array
               if(empty($department)){
                 ?><div class="card">
                 <img src="./departments/icon-1.png">
                 <h4>Know More about Our Doctors and faculty.</h4>
                 <br>
                 <p>We have experienced doctors assisted by hardworking faculty for your care.
                    Top-of-the-line infrastructure combined with modern medicine will serve you and all your health needs.
                 </p>
                 <input type="button" class ="button" onclick="location.href='#';" value ="Learn More about Our Services.">
               </div><?php
               }else{
               $j=0;
               for($j; $j<$rowcount; $j++){
                   switch($department[$j]){        // Using switch case to compare the departments and suggest results accordingly
                     case 'Oncology':  ?>
                                         <div class="card">
                                         <img src="./departments/icon-1.png">
                                         <h4>Know More about Oncology.</h4>
                                         <br>
                                         <p>Oncology deals with cancer, cancer ailments and all the cancer related treatments.
                                            There have been significant leaps in cancer reasearch.
                                            Our doctors and our treatment faculty will provide you with the best care needed.
                                         </p>
                                         <input type="button" onclick="location.href='./departments/oncology/oncology.php';" value ="Learn More about Oncology" class ="button">
                                       </div>
                                       <?php break;
                     case 'Nephrology':  ?>
                                         <div class="card">
                                         <img src="./departments/icon-6.png">
                                         <h4>Know More about Nephrology.</h4>
                                         <br>
                                         <p>Nephrology deals with kidney related ailments and all the kidney related treatments.
                                            There have been significant leaps in kidney reasearch.
                                            Our doctors and our treatment faculty will provide you with the best care needed.
                                         </p>
                                         <input type="button" onclick="location.href='#';" value ="Learn More about Nephrology" class ="button">
                                       </div>
                                       <?php break;
                     case 'Orthopedics':  ?>
                                         <div class="card">
                                         <img src="./departments/icon-5.png">
                                         <h4>Know More about Orthopedics.</h4>
                                         <br>
                                         <p>Orthopedics deals with bones and skeleto-muscular system.
                                            There have been significant leaps in Orthopedics reasearch.
                                            Our doctors and our treatment faculty will provide you with the best care needed.
                                         </p>
                                         <input type="button" onclick="location.href='#';" value ="Learn More about Orthopedics" class ="button">
                                       </div>
                                       <?php break;
                     case 'OB/Gyn':  ?>
                                         <div class="card">
                                         <img src="./departments/icon-5.png">
                                         <h4>Know More about OB/Gyn.</h4>
                                         <br>
                                         <p>OB/Gyn deals with reproductive system of female.
                                            There have been significant leaps in OB/Gyn reasearch.
                                            Our doctors and our treatment faculty will provide you with the best care needed.
                                         </p>
                                         <input type="button" onclick="location.href='#';" value ="Learn More about OB/Gyn" class ="button">
                                       </div>
                                       <?php break;
                     case 'Neurology':  ?>
                                       <div class="card">
                                       <img src="./departments/icon-5.png">
                                       <h4>Know More about Neurology.</h4>
                                       <br>
                                       <p>Neurology deals with human brain and all the brain related treatments.
                                          There have been significant leaps in Neurology reasearch.
                                          Our doctors and our treatment faculty will provide you with the best care needed.
                                       </p>
                                       <input type="button" onclick="location.href='#';" value ="Learn More about Neurology" class ="button">
                                     </div>
                                       <?php break;
                     case 'Ophthalmology':  ?>
                                       <div class="card">
                                       <img src="./departments/icon-5.png">
                                       <h4>Know More about Ophthalmology.</h4>
                                       <br>
                                       <p>Ophthalmology deals with eyes and all the eyes related treatments.
                                          There have been significant leaps in Ophthalmology reasearch.
                                          Our doctors and our treatment faculty will provide you with the best care needed.
                                       </p>
                                       <input type="button" onclick="location.href='#';" value ="Learn More about Ophthalmology" class ="button">
                                     </div>
                                       <?php break;
                     case 'ENT':  ?>
                                       <div class="card">
                                       <img src="./departments/icon-5.png">
                                       <h4>Know More about ENT.</h4>
                                       <br>
                                       <p>ENT deals with ear, nose, throat and all the ENT related treatments.
                                          There have been significant leaps in ENT reasearch.
                                          Our doctors and our treatment faculty will provide you with the best care needed.
                                       </p>
                                       <input type="button" onclick="location.href='#';" value ="Learn More about ENT" class ="button">
                                     </div>
                                       <?php break;
                     case 'Cardiology':  ?>
                                         <div class="card">
                                         <img src="./departments/icon-4.png">
                                         <h4>Know More about Cardiology.</h4>
                                         <br>
                                         <p>Cardiology deals with heart, heart ailments and all the heart related treatments.
                                            There have been significant leaps in Cardiology reasearch.
                                            Our doctors and our treatment faculty will provide you with the best care needed.
                                         </p>
                                         <input type="button" onclick="location.href='#';" value ="Learn More about Cardiology" class ="button">
                                       </div>
                                       <?php break;

                                     }
                 }}?>
          </div>


            <section class="doctor">
              <div class="doctor-list">
                <h1>Patients Reports</h1>
                <?php if($isValid && isset($check_subs_validity['user_id'])){
?>
                  <p id="validity">Subscription Validity: <?php echo $see;?> days left</p>
                  <input type="button" id ="updatebutton" onclick="location.href='../subscription model/update_subs.php?id=<?php echo $id?>';" value="Update My Subscription" />
<?php }else{
?>
                  <p id="validity">Subscription Validity: You haven't subscribed</p>
                  <input type="button" id ="updatebutton" onclick="location.href='../subscription model/index.php?id=<?php echo $id?>';" value="Subscribe" />
<?php
}
?>                  <table class="table" id="targetTable">
                    <thead>
                      <tr>
                      <th>Appointment No.</th>
                      <th>Patient's Name</th>
                      <th>Report</th>
                      </tr>
                    </thead>
                    <?php

                    // to get the rows of appointments by that user
                    $recordsrow = "SELECT * FROM booking_records WHERE user_id ='$id'";
                    $recordscount = mysqli_query($conn,$recordsrow);
                    $recordsrowcount=mysqli_num_rows($recordscount);


                    // to get the appointment numbers of that user (could be multiple, so usage of array)
                    $forappon = "SELECT * FROM booking_records WHERE user_id ='$id'";
                    $records = mysqli_query($conn,$forappon);
                    while(($user = $records->fetch_assoc()) != false){   // until assosiative array is empty (false)
                    $appointno[] = $user['id'];        // store dname in an array
                    }

                    // getting the data from reports database using the appointment numbers and rowcount for number of patients
                    for($j=0;$j<$recordsrowcount;$j++){
                      $forrecords = "SELECT * FROM reports WHERE appointment_no ='$appointno[$j]'";
                      $resultrecord = mysqli_query($conn,$forrecords);
                      $user = $resultrecord->fetch_assoc();
                      if($user){?>

                        <tbody>
                          <tr>
                            <td><?php echo $user['appointment_no'];?></td>
                            <td><?php echo $user['pname'];?></td>
                            <td><input type="button" class ="button" onclick="location.href='../report_pdf/generate_pdf.php?id=<?php echo $user['appointment_no']?>';" value="View Report" /></td>
                          </tr>
                        </tbody>

                        <?php }  } ?>
               </table>
           </div>
         </section>
        </div>
     </body>
     </html>
