<?php

include '../services/dbconn.php';


// this page is accessible only to the admin 

$appointment_no = $_POST['appointment_no'];
$pname = $_POST['pname'];
$hemoglobin = $_POST['hemoglobin'];
$cholesterol = $_POST['cholesterol'];
$rbc_count = $_POST['rbc_count'];

//  echo "Patient's Name: ".$pname."Hemolgobin: ".$hemoglobin."Cholesterol: ".$cholesterol."rbc_count: ".$rbc_count;



// Needs to session start admin part of the report insertion, otherwise anyone can insert wrong record
// admin validation is required here, right now there is no such mechanism

  $sql = "INSERT INTO reports (appointment_no,pname,hemoglobin,cholesterol,rbc_count)
        VALUES('$appointment_no','$pname','$hemoglobin','$cholesterol','$rbc_count')";

    $result = mysqli_query($conn,$sql); // passing the sql code through conn into the database
    if ($result){

  ?>
      <script>
      alert("Report Insertion successful !!");
      window.location.href = "for_lab.html";
      </script>

<?php
}
?>
