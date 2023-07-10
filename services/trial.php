<?php
include "dbconn.php";
$id = isset($_POST['appointment_number']) ? $_POST['appointment_number'] :'';
  //echo $id;
$for_reports = "SELECT * FROM reports WHERE appointment_no ='$id'";
$aresult = mysqli_query($conn,$for_reports);
$result = mysqli_query($conn,$for_reports);
$auser = $aresult->fetch_assoc();
if (empty($auser['appointment_no'])){              // compare just the id section of the assosiative array, if empty, no data
  ?>
    <script>
      alert("Report for this appointment doesn't exist!!");
      window.location.href = "analytics.php";
    </script>
  <?php
}else{
while(($user = $result->fetch_assoc()) != false){
$report_id = $user['id'];
$rbc_count = $user['rbc_count'];
$name = $user['pname'];
$hemoglobin = $user['hemoglobin'];
$cholesterol = $user['cholesterol'];
}}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report Analysis</title>
     <link rel="stylesheet" href="./trial.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
       rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Test elements', 'Standard', 'Patient'],
          ['Hemoglobin (13.2-16.6 g/dL)', 14.5, <?php echo $hemoglobin;?>],

        ]);
        var data2 = new google.visualization.arrayToDataTable([
          ['Test elements', 'Standard', 'Patient'],
          ['Cholesterol (<200mg/dL)', 200, <?php echo $cholesterol;?>],

        ]);
        var data3 = new google.visualization.arrayToDataTable([
          ['Test elements', 'Standard', 'Patient'],
          ['RBC Count (4.0-5.9 x 10*12/L)', 4000000000000, <?php echo $rbc_count;?>],

        ]);
        var options = {
          width: 400,
          chart: {
            title: 'Standard-Patient',
            subtitle: 'Standard-Patient ratio based on your report'
          },
          bars: 'vertical', // Required for Material Bar Charts.
          series: {
            0: { axis: 'standard' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'patients' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            x: {
              distance: {label: 'Blood Elements'},
              brightness: {side: 'top', label: 'Blood level'} // Bottom x-axis.
              }
          }
        };

      var chart = new google.charts.Bar(document.getElementById('hemo'));
      chart.draw(data, options);
      var chart1 = new google.charts.Bar(document.getElementById('chol'));
      chart1.draw(data2, options);
      var chart2 = new google.charts.Bar(document.getElementById('red'));
      chart2.draw(data3, options);
    };
    </script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
  <div id="top">
    <div class="topleft">
        <p><?php echo "Report No.: ".$report_id; ?></p>
        <p><?php echo "Appointment No.: ".$id; ?></p>
        <p><?php echo "Patient's Name: ".$name;?></p>
    </div>
    <div class="topright">
          <p><?php   echo "Hemoglobin count: ".$hemoglobin; ?></p>
          <p><?php   echo "Choleterol count: ".$cholesterol; ?></p>
          <p><?php   echo "RBC count: ".$rbc_count; ?></p>
    </div>
  </div>
  <div class="overall" style="display: flex; padding right: 50px;">
  <div id="hemo"></div>
  <div id="chol"></div>
  <div id="red"></div>
  </div>
  <div class="bottom">
    <p>Based on your reports, you might have</p>
    <ul>
      <?php
          if($hemoglobin < 13.2){
            ?><li>Risk of Anemia</li><?php
          }elseif($hemoglobin > 16.6){
            ?> <li>Risk of Polycythemia</li><?php
          }else{
            ?><li>Your Hemoglobin level is normal</li><?php
          }?>
      <?php if($cholesterol < 120){
            ?><li>Risk of Cancer/Hemorrhagic stroke</li><?php
          }elseif($cholesterol > 240){
            ?> <li>Risk of Atherosclerosis</li><?php
          }else{
            ?><li>Your Cholesterol level is normal</li><?php
          }?>
    </ul>
    <p id="disclaimer">Disclaimer:<p>
    <p id="disdis">This report analysis shouldn't be taken as a professional's analysis. We recommend you to make an appointment with a doctor and show your test results to the doctor for further treatment. If you already have an appointment, then show your doctor this report during your follow-up checkup.</p>
    <p><a href="./reports.php">You can download your report here</a></p>
    <p><a href="./appointment.php">You can book an appointment here</a></p>
  </div>
</body>
</html>
