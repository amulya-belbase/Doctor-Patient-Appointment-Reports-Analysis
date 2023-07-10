<?php
    include 'dbconn.php';



    session_start();

    $id = $_SESSION["user_id"];



    if (isset($id)){
    $delete_id = '';
    $delete_id = (isset($_GET['id']) ? $_GET['id'] : '');
  // echo $delete_id;

    $sql = "DELETE FROM booking_records WHERE id = '$delete_id'";      // deleting that particular id
    $result = mysqli_query($conn,$sql);
    if ($result){
      ?> <script>
        alert("Appointment deleted successfully!");
          window.location.href = "my_appointments.php";
      </script>
      <?php
    }else{
      die($conn->error. " ". $conn->errno);
    }}
    else{?><script>
      alert("You haven't logged in!!");
      window.location.href = "../signup/login.php";
    </script>
<?php }
 ?>
