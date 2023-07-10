<?php
include "../services/dbconn.php";

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$country = $_POST['country'];
$zipcode = $_POST['zipcode'];
$cardname = $_POST['cardname'];
$cardnumber = $_POST['cardnumber'];
$expdate = $_POST['expdate'];
$cvv = $_POST['cvv'];


date_default_timezone_set('Asia/Shanghai');
$date = date('Y-m-d H:i:s');

$check = "SELECT * FROM subscription WHERE user_id='$id'"; // to avoid user duplication, one user->one subscription
$checkresult = mysqli_query($conn,$check);
$getid = $checkresult->fetch_assoc();
if(isset($getid['user_id'])){
  $update = "UPDATE subscription SET name = '$name', email ='$email',
                                    address = '$address',city = '$city',country = '$country',
                                    zipcode = '$zipcode',cname = '$cardname',cnumber = '$cardnumber',
                                    exdate = '$expdate',cvv = '$cvv',subsdate='$date'
                                    WHERE user_id = $id "; // to avoid user duplication, one user->one subscription
$result = mysqli_query($conn,$update);
          if ($result){
            ?>  <script>
                alert("Update successful !!");
                window.location.href = "../services/reports.php";
                </script>

        <?php }else{
              die($conn->error. " ". $conn->errno);
        }}
else{
$sql = "INSERT INTO subscription (user_id,name,email,address,city,country,zipcode,cname,cnumber,exdate,cvv,subsdate)
        VALUES('$id','$name','$email','$address','$city','$country','$zipcode','$cardname','$cardnumber','$expdate','$cvv','$date')";

$result = mysqli_query($conn,$sql); // passing the sql code through conn into the database
if ($result){

   ?>
       <script>
       alert("Subscription successful !!");
       window.location.href = "../services/reports.php";
       </script>

 <?php
}}
 ?>
