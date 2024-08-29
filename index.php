<?php

session_start();
include "./database/dbConnection.php";
if (isset($_SESSION['userid'])) {
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("
  SELECT usertype FROM register WHERE userid = :userid
");
  $stmt->bindParam(':userid', $_SESSION['userid'], PDO::PARAM_STR);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  switch ($user['usertype']) {
    case 'mswd':
      header("Location: ./includes/HomePage.php");
      break;
    case 'barangay':
      header("Location: ./includes/barangay.php");
      break;
    default:
      header("Location:./index.php");
      break;
  }
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRYMWACH</title>
  <link rel="shortcut icon" href="./images//assets/Screenshot_2024-06-11_193516-removebg-preview.png" type="image/x-icon">
  <link rel="stylesheet" href="./css//index.css">
  <link rel="stylesheet" href="./css//icons.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <div class="left-section">
      <img src="images/assets/trylogin.png" alt="Welcome Image" class="welcome-image left-image">
      <h1 class="welcome-text">Welcome!</h1>
      <p class="description">You are where you find the best you are looking for just login!</p>
      <a class="login-button" href="./includes/loginPage.php">Login</a>
    </div>
    <div class="right-section">
      <img src="images/assets/register.png" alt="Register Image" class="register-image">
      <h1 class="register-heading">Create an Account</h1>
      <p class="register-description">Please complete your registration</p>
      <form id="registration-form">
        <input type="text" placeholder="Fullname" class="text-input" id="fullname" required>
        <select class="dropdown" id="gender" required>
          <option value="" disabled selected>Select Gender</option>
          <option value="gender">Male</option>
          <option value="gender">Female</option>
        </select>
        <select class="dropdown" id="usertype" required>
          <option value="" disabled selected>Select Position</option>
          <option value="mswd">MSWD</option>
          <option value="barangay">BARANGAY</option>
        </select>
        <select class="dropdown" id="barangay" required>
          <option value="" disabled selected>Select Barangay</option>
          <option value="Agunod">Agunod</option>
          <option value="Bato">Bato</option>
          <option value="Buena Voluntad">Buena Voluntad</option>
          <option value="Calaca-an">Calaca-an</option>
          <option value="Cartagena Proper">Cartagena Proper</option>
          <option value="Catarman">Catarman</option>
          <option value="Cebulin">Cebulin</option>
          <option value="Clarin">Clarin</option>
          <option value="Danao">Danao</option>
          <option value="Deboloc">Deboloc</option>
          <option value="Divisoria">Divisoria</option>
          <option value="Eastern Looc">Eastern Looc</option>
          <option value="Ilisan">Ilisan</option>
          <option value="Katipunan">Katipunan</option>
          <option value="Kauswagan">Kauswagan</option>
          <option value="Lao Proper">Lao Proper</option>
          <option value="Lao Santa Cruz">Lao Santa Cruz</option>
          <option value="Looc Proper">Looc Proper</option>
          <option value="Mamanga Daku">Mamanga Daku</option>
          <option value="Mamanga Gamay">Mamanga Gamay</option>
          <option value="Mangidkid">Mangidkid</option>
          <option value="New Cartagena">New Cartagena</option>
          <option value="New Look">New Look</option>
          <option value="Northern Poblacion">Northern Poblacion</option>
          <option value="Panalsalan">Panalsalan</option>
          <option value="Puntod">Puntod</option>
          <option value="Quirino">Quirino</option>
          <option value="Santa Cruz">Santa Cruz</option>
          <option value="Southern Looc">Southern Looc</option>
          <option value="Southern Poblacion">Southern Poblacion</option>
          <option value="Tipolo">Tipolo</option>
          <option value="Unidos">Unidos</option>
          <option value="Usocan">Usocan</option>

        </select>
        <input type="text" placeholder="Complete Address" class="text-input" id="complete-address" required>
        <input type="tel" placeholder="Phonenumber" maxlength="10" pattern="^[1-9]\d{9}$"  class="text-input" id="phonenumber" required>
        <input type="email" placeholder="Email" class="text-input" id="email" required>
        <input type="password" placeholder="Password" class="text-input" id="password" required>
        <button type="submit" class="register-button">Register</button>
      </form>
    </div>
  </div>

  <script src="./js/index.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/7.14.1-0/firebase.js"></script>
  <script src="./firebase/firebaseConfig.js"></script>
  <!--
    ajax area
  -->
  <script>
    $(document).ready(function() {
      $('#registration-form').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting via the browser
        // Get values from form fields
        const userid = Math.floor(1000 + Math.random() * 9000);
        const usertype = document.getElementById("usertype").value;
        const fullname = document.getElementById("fullname").value;
        const gender = document.getElementById("gender").value;
        const barangay = document.getElementById("barangay").value;
        const completeAddress = document.getElementById("complete-address").value;
        const phonenumber = document.getElementById("phonenumber").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;


        // firebase authentication area
        const auth = firebase.auth();
        auth.createUserWithEmailAndPassword(email, password)
          .then((userCredential) => {
            $.ajax({
              url: './database/register.php', // URL of the server-side script
              method: 'POST',
              data: {
                userid: userid,
                usertype: usertype,
                fullname: fullname,
                gender: gender,
                barangay: barangay,
                address: completeAddress,
                phone: phonenumber,
                email: email,
                password: password
              },
              success: function(response) {},
              error: function(jqXHR, textStatus, errorThrown) {
                $('#result').html('<p style="color: red;">An error occurred: ' + textStatus + '</p>');
              }
            });
            // connect to firebase realtime database area
            const regist = firebase.database().ref("register");
            regist.push().set({
              userid: userid,
              usertype: usertype,
              fullname: fullname, 
              gender: gender,
              barangay: barangay,
              address: completeAddress,
              phone: phonenumber,
              email: email,
              password: password,
            });
            document.getElementById("registration-form").reset();
            Swal.fire({
              title: "SUCCESSFULLY!",
              text: "Register Successfully!",
              icon: "success",
            });
            //end connect to firebase realtime database area
          })
          .catch((error) => {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: error.message,
            });
          });
        // end firebae authentication area
      });

    });
  </script>
  <!--
   end ajax area
  -->
</body>

</html>