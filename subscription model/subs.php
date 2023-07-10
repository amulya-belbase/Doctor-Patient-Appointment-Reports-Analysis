<?php
include "../signup/database.php";

session_start();
if (isset($_SESSION["user_id"])){
$id = $_GET['id'];
$name = $_GET['name'];}
else{
  ?><script>
    alert("You haven't logged in!!");
    window.location.href = "../signup/login.php";
  </script>
<?php }
?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Payment</title>
     <link rel="stylesheet" href="subsstyle.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
       rel="stylesheet">
   </head>
   <body>
<div class="container">

    <form action="subsaction.php" method="post">

        <div class="row">

            <div class="col">

                <h3 class="title">Billing Details</h3>

                <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" name ="name" placeholder="Full Name">
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" name ="email" placeholder="example@example.com">
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" name ="address" placeholder="Street-Town-District">
                </div>
                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" name ="city" placeholder="Beijing">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Country :</span>
                        <input type="text" name ="country" placeholder="China">
                    </div>
                    <div class="inputBox">
                        <span>zip code :</span>
                        <input type="text" name ="zipcode" placeholder="123 456">
                    </div>
                </div>

            </div>
            <div class="verticalLine"></div>
            <div class="col">

                <h3 class="title">Payment Details</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="./img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>name on your card :</span>
                    <input type="text" name ="cardname" placeholder="John Doe">
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" name ="cardnumber" placeholder="1111-2222-3333-4444">
                </div>
                <div class="inputBox">
                    <span>expiry date :</span>
                    <input type="date" name="expdate">
                </div>


                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" name ="cvv" placeholder="1234">
                    </div>
                </div>

            </div>

        <input type="submit" value="Confirm" class="submit-btn">
        <input type = "hidden" name = "id" id ="id" value = "<?php echo $id; ?>" required>
    </form>

</div>

   </body>
 </html>
