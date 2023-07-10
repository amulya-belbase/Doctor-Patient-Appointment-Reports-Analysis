<?php

include 'dbconn.php';

session_start();


$pname = $_POST['pname'];
$dname = $_POST['dname'];
$department = $_POST['department'];
$appointment = $_POST['appointment'];
$sympd = $_POST['sympd'];
$contact = $_POST['contact'];

// echo "Patient's Name: ".$pname."Doctor's name: ".$dname."Appointment Date: ".$appointment."Symptoms: ".$sympd;


$id = $_SESSION["user_id"];
// echo $id;
if (isset($id)){
  $sql = "INSERT INTO booking_records (user_id,pname,dname,department,appointment,sympd,contact)
        VALUES('$id','$pname','$dname','$department','$appointment','$sympd','$contact')";

    $result = mysqli_query($conn,$sql); // passing the sql code through conn into the database
    if ($result){

  ?>
      <script>
      alert("Booking successful !!");
      window.location.href = "my_appointments.php";
      </script>

<?php
}} else{
?>
  <script>
  alert("You need to login first!");
  window.location.href = "../signup/login.php";
  </script>

<?php }
exit;
