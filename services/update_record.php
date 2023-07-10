<?php
    include 'dbconn.php';
    session_start();

    $id = $_SESSION["user_id"];



    if (isset($id)){
    $update_id = '';
    $update_id = (isset($_GET['id']) ? $_GET['id'] : '');
    $sql = "SELECT * FROM booking_records WHERE id ='$update_id'";
    $result = mysqli_query($conn,$sql); // passing the sql code through conn into the database, to get displaying results
    $user = $result->fetch_assoc();
    if ($user){
          $pname = $user['pname'];     // getting the value
          $dname = $user['dname'];            // storing inorder to show the value before the edit
          $department = $user['department'];
          $contact = $user['contact'];
          $sympd = $user['sympd'];
          $appointment = $user['appointment'];

    }}else{?><script>
      alert("You haven't logged in!!");
      window.location.href = "../signup/login.php";
    </script>
<?php }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="update_record.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
      rel="stylesheet">
  </head>
  <body>
    <div class="towrap">
    <div class="overlay" id="divTwo">
      <div class="wrapper">
          <h2>Update Your Appointment</h2>
          <a onclick="showAlert()" class="close" id="closetab">&times;
            <script>
                function showAlert(){
                  if(confirm("All changes made will be lost. Are you sure you want to go back?")){
                  window.location.href = "my_appointments.php";
                }}
            </script>
          </a>
          <div class="content">
            <div class="container">
              <form action="update_record_action.php" method="post" id="popup2">
                  <label>Patient's Name</label>
                  <input type="text" name="pname" placeholder="Your Name" id="patientname" value = <?php var_export($pname); ?>>
                  <label>Doctor's Name</label>
                  <input type="text" name="dname" placeholder="Doctor Name" id="docname" readonly value = <?php var_export($dname); ?>>
                  <label>Department</label>
                  <input type="text" name="department" placeholder="Department" id="departmentname" readonly value = <?php echo $department; ?>>
                  <label>Contact No.</label>
                  <input type="text" name="contact" placeholder="Contact No." id="contact" value = <?php echo $contact; ?>>
                  <label for="birthday">Appointment Date:</label>
                  <input type="date" id="appointment" name="appointment" value = <?php echo $appointment; ?>>
                  <br>
                  <label>Your symptoms:</label>
                  <textarea name="sympd" placeholder="Your Symptoms Here..."><?php echo $sympd; ?></textarea>
                  <input type = "hidden" name = "update_id" id ="update_id" value = "<?php echo $update_id; ?>" required>
                  <input type="submit" value="Update" id="formsub">
              </form>
            </div>
          </div>
      </div>
    </div>
    </div>
  </body>
</html>
