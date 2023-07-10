<?php

require __DIR__ . "/vendor/autoload.php";
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options;
$options -> setChroot(__DIR__);
$options -> setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);   // creating a dompdf obejct

include "../services/dbconn.php";
  $id = $_GET['id'];
//  echo $id;

$sql = "SELECT * FROM reports WHERE appointment_no = '$id'";
$result = mysqli_query($conn,$sql); // passing the sql code through conn into the database
$user = $result->fetch_assoc();
if($user){
  $report_no = $user['id'];
  $appointment_no = $user['appointment_no'];
  $patient_name = $user['pname'];
  $hemoglobin = $user['hemoglobin'];
  $cholesterol = $user['cholesterol'];
  $rbc_count = $user['rbc_count'];
}

$html = '
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    body{
      font-family: Oswald;
    }
    .container{
      padding: 20px;
      padding-bottom: 0px;
    }
    #img{
      display: block;
      margin-top: 0%;
      margin-left: 35%;
      margin-right: auto;
      width: 30%;
    }
    #appcss{
      margin-top: 0px;
      padding-top: 0px;
      margin-bottom: 0px;
    }
    #reportcss{
      border-top: 2px solid #00636E; /*#004047*/
      padding-top: 10px;
      margin-bottom: 0px;
    }
    #namecss{
      margin-top: 0px;
      border-bottom: 2px solid #004047; /*#004047*/
      padding-bottom: 10px;
      margin-bottom: 0px;
    }
    #reportnamecss{
      text-align: center;
      margin-top: 0px;
      text-decoration: underline;
    }

    .table{
      border-collapse: collapse;
      margin-left: 25%;
      font-size: 20px;
      min-width: 50%;
      overflow: hidden;
      border-radius: 0.5rem;
    }
    table th{
      color: #fff;
      background: #00636E;
      text-align: center;
      font-weight: bold;
    }
    table tr{
      border-bottom: 3px solid #ddd;
      text-align: center;
      background: #f3f3f3;
    }

    table tr:last-of-type{   /* fpr last row, change to this border*/
      border-bottom: 2px solid #00636E;
    }

    </style>
  </head>
  <body>
    <div class="container">

      <img src="./logo.jpg" id="img">
      <h3 id="reportcss">Report No.: '.$report_no.'</h3>
      <h3 id="appcss">Appointment No.: '.$appointment_no.'</h3>
      <h3 id="namecss">Name: '.$patient_name.'</h3>
      <h1 id="reportnamecss">Blood Report</h1>


    <table class="table">
      <tr>
        <th>Hemoglobin <br>(13.2-16.6 g/dL)</th>
        <td>'.$hemoglobin.'</td>
      </tr>
      <tr>
        <th>Cholesterol <br>(<200mg/dL)</th>
        <td>'.$cholesterol.'</td>
      </tr>
      <tr>
        <th>RBC Count <br>(4.0-5.9 x 10*12/L)</th>
        <td>'.$rbc_count.'</td>
      </tr>
    </table>
</div>
  </body>
</html>';


// ========================================= for pdf ============================================

    include "../signup/database.php";
    include "../services/dbconn.php";
session_start();
$user = $_SESSION["user_id"];             // to see if the user is logged in or not
$isValid = false;
if ($user){
  $check_subs = "SELECT * FROM subscription WHERE user_id='$user'";
  $result_subs = mysqli_query($conn,$check_subs);
  $check_subs_validity = $result_subs->fetch_assoc();
if($check_subs_validity){
  $date = $check_subs_validity['subsdate'];

  date_default_timezone_set('Asia/Shanghai');
  $currentdate = date('Y-m-d H:i:s');

    // Creates DateTime objects
    $datetime1 = date_create($currentdate);
    $for_date_diff = date('Y-m-d', strtotime($date. ' + 30 days'));   // add 30 days to the subs date
    $validate = date_create($for_date_diff);

    if($datetime1<$validate){
      $isValid = true;
    }
  else{
    $isValid = false;
  }}

  if($isValid && isset($check_subs_validity['user_id'])){

    $dompdf -> loadHTML($html);
    $dompdf -> setPaper("A4", "portrait");   // setting the document dimensions

    $dompdf -> render();    // turning html code into pdf

    $dompdf -> addInfo("Title", "Blood Report");    // setting the documnet attribute, case sensitive, set only after render property

    $dompdf -> stream("test_results.pdf",['Attachment' => 0]);        // converting rendered file into browser accessible pdf file

    $output = $dompdf -> output();
  }else{
    ?><script>
      if(confirm("For viewing the reports, you have to make/renew your subscription. Click OK for making/renewing subscription")){
      window.location.href = "../subscription model/index.php";}
      else{
        window.location.href ="../services/reports.php";
      }
    </script>
  <?php }
}else{
  ?><script>
    alert("You haven't logged in!!");
    window.location.href = "../signup/login.php";
  </script>
<?php }
?>
