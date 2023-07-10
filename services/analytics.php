<?php
      include "../signup/database.php";
      include "./dbconn.php";
session_start();
if (isset($_SESSION["user_id"])){
$id = $_SESSION["user_id"];

// for appointment based analytics
$forname = "SELECT * FROM user
                WHERE id = '$id'";
$result = mysqli_query($mysqli,$forname); // passing the sql code through conn into the database
$user = $result->fetch_assoc();
if ($user){
      $name = $user['name'];
    }
    $rows = "SELECT * FROM booking_records WHERE user_id ='$id'";
$count = mysqli_query($conn,$rows);
$rowcount=mysqli_num_rows($count);
//echo $rowcount;

$for_appointments = "SELECT * FROM booking_records WHERE user_id ='$id'";
$aresult = mysqli_query($conn,$for_appointments);
//$app = $aresult->fetch_assoc();
$j = 0;
for($j; $j<$rowcount; $j++){
  while(($app = $aresult->fetch_assoc()) != false){
  $appointment_id_array[] = $app['id'];
  //echo $appointment_id_array[$j];
    break;
}}
}?><?php

// for doctor's piechart
$for_doc_pie = "SELECT * FROM doctor_list";
$doc_result = mysqli_query($conn,$for_doc_pie);
$doc_result_row = mysqli_query($conn, $for_doc_pie);
$doc_rowcount=mysqli_num_rows($doc_result_row);
//echo $doc_rowcount;
if ($doc_result){
  while (($doc_entry = $doc_result -> fetch_assoc()) != false){
  $department[] = $doc_entry['department'];
  $gender[] = $doc_entry['gender'];
}}
  /*print_r($department);
  print_r($gender);*/
  $male = 0;
  $female = 0;
for ($n=0;$n<$doc_rowcount;$n++){
  switch($gender[$n]){
      case 'm': $male++;
                break;
      case 'f': $female++;
                break;
  }
}
/*echo "Male number: ".$male;
echo "Female number: ".$female;*/

$oncology = 0;
$neurology = 0;
$ent = 0;
$obg = 0;
$opth = 0;
$ortho = 0;
$nephr = 0;
$cardio = 0;
for ($p=0;$p<$doc_rowcount;$p++){
switch($department[$p]){
    case 'Oncology': $oncology++;
                      break;
    case 'Neurology': $neurology++;
                      break;
    case 'ENT':       $ent++;
                      break;
    case 'OB/Gyn': $obg++; break;
    case 'Ophthalmology': $opth++; break;
    case 'Orthopedics': $ortho++; break;
    case 'Nephrology': $nephr++; break;
    case 'Cardiology': $cardio++; break;
}
}
/*echo "Oncology number: ".$oncology;
echo "Neurology number: ".$neurology;
echo "ENT number: ".$ent;*/

?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Analytics</title>
    <link rel="stylesheet" href="analytics.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
      rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawLeftChart);

      function drawLeftChart() {
        var departdata = google.visualization.arrayToDataTable([
          ['Department', 'Number'],
          ['Oncology',     <?php echo $oncology;?> ],
          ['ENT',      <?php echo $ent;?>],
          ['Neurology', <?php echo $neurology;?>],
          ['Ophthalmology',      <?php echo $opth;?>],
          ['OB/Gyn',      <?php echo $obg;?>],
          ['Orthopedics',      <?php echo $ortho;?>],
          ['Nephrology',      <?php echo $nephr;?>],
          ['Cardiology',      <?php echo $cardio;?>]
        ]);
        var optionstwo = {
          title: 'Doctor-Department Ratio',
          is3D: true,
        };

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'Type'],
          ['Male',     <?php echo $male;?> ],
          ['Female',      <?php echo $female;?>]
        ]);
        var options = {
          title: 'Doctor-Gender Ratio'
        };

        var piechart = new google.visualization.PieChart(document.getElementById('rightpiechart'));
        piechart.draw(departdata, optionstwo);

        var chart = new google.visualization.PieChart(document.getElementById('leftpiechart'));
        chart.draw(data, options);

      }
    </script>
</head>

  <body>
    <div class="container1">
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
          <h2 id="line">Report Analysis</h2>
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
        <form class="filters" action="./trial.php" target="_blank" method="post">
      Choose your appointment number:
      <select class="fetch" name="appointment_number" id="bydept">
        <?php for($m=0;$m<$rowcount;$m++){?>
        <option value="<?php echo $appointment_id_array[$m]?>"><?php echo $appointment_id_array[$m]?></option>
      <?php }?>
      </select>
      <input type = "submit" value = "Submit" id="sub">
    </form>

  <div class="lower">
    <h2>Faculty Analysis</h2>
    <div class="docpie">
      <div class="leftpiechart" id="leftpiechart">
      </div>
      <div class="rightdocpie" id="rightpiechart">
      </div>
    </div>
    <div class="appoanalysis">
      <div class="toppart">
        <h2>Patients-Doctors-Department Analysis</h2>
      </div>
      <div class="bottompart">
        <table class="table" id="targetTable">
            <thead>
              <tr>
              <th>No. of Patients</th>
              <th>No. of Doctors</th>
              <th>Department</th>
              </tr>
           </thead>
<?php

// for doctor's piechart
$for_patient_number = "SELECT * FROM booking_records";
$patient_result = mysqli_query($conn,$for_patient_number);
$patient_result_row = mysqli_query($conn, $for_patient_number);
$patient_rowcount=mysqli_num_rows($patient_result_row);
//echo $patient_rowcount;
if ($patient_result){
  while (($patient_entry = $patient_result -> fetch_assoc()) != false){
  $patient_department[] = $patient_entry['department'];
}}
  //print_r($patient_department);

$patient_onc = 0;
$patient_neuro = 0;
$patient_ent = 0;
$patient_obg = 0;
$patient_opth = 0;
$patient_ortho = 0;
$patient_nephr = 0;
$patient_cardio = 0;
for ($q=0;$q<$patient_rowcount;$q++){
switch($patient_department[$q]){
    case 'Oncology': $patient_onc++; break;
    case 'Neurology': $patient_neuro++; break;
    case 'ENT': $patient_ent++; break;
    case 'OB/Gyn': $patient_obg++; break;
    case 'Ophthalmology': $patient_opth++; break;
    case 'Orthopedics': $patient_ortho++; break;
    case 'Nephrology': $patient_nephr++; break;
    case 'Cardiology': $patient_cardio++; break;
}
}?>
           <tbody>
             <tr>
               <td><?php echo $patient_onc; ?></td>
               <td><?php echo $oncology; ?></td>
               <td>Oncology</td>
             </tr>
             <tr>
               <td><?php echo $patient_neuro; ?></td>
               <td><?php echo $neurology; ?></td>
               <td>Neurology</td>
             </tr>
             <tr>
               <td><?php echo $patient_ortho; ?></td>
               <td><?php echo $ortho ; ?></td>
               <td>Orthopedics</td>
             </tr>
             <tr>
               <td><?php echo $patient_opth; ?></td>
               <td><?php echo $opth ; ?></td>
               <td>Ophthalmology</td>
             </tr>
             <tr>
               <td><?php echo $patient_cardio; ?></td>
               <td><?php echo $cardio; ?></td>
               <td>Cardiology</td>
             </tr>
             <tr>
               <td><?php echo $patient_obg; ?></td>
               <td><?php echo $obg; ?></td>
               <td>OB/Gyn</td>
             </tr>
             <tr>
               <td><?php echo $patient_nephr; ?></td>
               <td><?php echo $nephr; ?></td>
               <td>Nephrology</td>
             </tr>
             <tr>
               <td><?php echo $patient_ent; ?></td>
               <td><?php echo $ent; ?></td>
               <td>ENT</td>
             </tr>
           </tbody>
         </table>
      </div>
    </div>
  </div>
    </section>
</body>
</html>
