

<?php
    include 'dbconn.php';
    session_start();

    $id = $_SESSION["user_id"];



    if (isset($id)){
      $newId = $_POST['update_id'];   // getting id from edit
      $pname = $_POST['pname'];
      $dname = $_POST['dname'];
      $department = $_POST['department'];
      $appointment = $_POST['appointment'];
      $sympd = $_POST['sympd'];
      $contact = $_POST['contact'];

      $sql = "UPDATE booking_records SET pname = '$pname', dname = '$dname', department ='$department',
                                          appointment = '$appointment',sympd = '$sympd',contact = '$contact'
                                          WHERE id = $newId ";
      $result = mysqli_query($conn,$sql);
      if ($result){
      ?>  <script>
        alert("Update successful !!");
        window.location.href = "my_appointments.php";
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
