<?php

session_start();

include "../database/dbConnection.php";
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
      header("Location: ../includes/HomePage.php");
      break;
    case 'barangay':
      header("Location: ../includes/barangay.php");
      break;
    default:
      header("Location:../index.php");
      break;
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../images//assets/Screenshot_2024-06-11_193516-removebg-preview.png" type="image/x-icon">
  <link rel="stylesheet" href="../css//loginpage.css">
  <title>LOGIN PAGE</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
  <form id="login-form">

    <div class="logo">
      <img src="../images//assets/Screenshot_2024-06-11_193516-removebg-preview.png" alt="Logo">
    </div>
    <!--<div class="radio-buttons">
      <input type="radio" id="option1" name="options" checked>
      <label for="option1" class="radio">MSWD</label>
      <input type="radio" id="option2" name="options">
      <label for="option2" class="radio">BARANGAY</label>
    </div> -->
    <fieldset>
      <label for="mail">Email:</label>
      <input type="email" id="email" placeholder="Enter your email" name="user_email" autocomplete="off" required>
      <label for="password">Password:</label>
      <input type="password" id="password" placeholder="Enter your password" name="user_password" required>
      <button type="submit" id="loginbtton">LOGIN</button>
  </form>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/7.14.1-0/firebase.js"></script>
  <script src="../firebase/firebaseConfig.js"></script>
  <script>
    $(document).ready(function() {
      $('#login-form').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting via the browser
        // Get values from form fields
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const auth = firebase.auth();
        auth.signInWithEmailAndPassword(email, password)
          .then((userCredential) => {
            $.ajax({
              url: '../database/loginDatabase.php', // URL of the server-side script
              method: 'POST',
              data: {
                email: email,
              },
              success: function(response) {
                window.location.reload();
                const data = JSON.parse(response);
                const usertype = data.usertype;
                
                switch (usertype) {
                  case "mswd":
                    window.location.href = "./HomePage.php";
                    break;
                  case "barangay":
                    window.location.href = "./barangay.php";
                    break;
                  default:
                    break;
                } 
              },
              error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
              }
            });

          })
          .catch((error) => {
            document.getElementById("login-form").reset();
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: 'Login Failed!',
            });
          });


      });

    });
  </script>

</body>

</html>