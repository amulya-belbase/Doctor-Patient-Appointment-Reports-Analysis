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

session_start();
if (isset($_SESSION["user_id"])){

date_default_timezone_set('Asia/Shanghai');
$date = date('Y-m-d H:i:s');

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
                    }
              }else{?><script>
              alert("You haven't logged in!!");
              window.location.href = "../signup/login.php";
              </script>
  <?php }
?>
