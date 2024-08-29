<?php
session_start();
include "../database/dbConnection.php";
if (!isset($_SESSION['userid'])) {
   // Redirect to another page (e.g., dashboard) if logged in
   // header("Location: ../main/dashboard.php");

   header("Location: ./loginPage.php");
}

// fetch name area
$stmt = $conn->prepare("SELECT fullname FROM register WHERE userid=:user_id");
$stmt->execute([
   ":user_id" => $_SESSION['userid'],
]);

$userinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Process the results
foreach ($userinfo as $user) {
   $fullname = $user['fullname'];
}

// end fetch name area
$userid = $_SESSION['userid'];  // get session id
// fetch count for incident report records area
$sql = "SELECT COUNT(submitid) AS submitcount FROM assestmentdatahistory";
// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->execute();
// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$submitCount = $result['submitcount'];
// fetch count for incident report records area

$sql = "SELECT COUNT(submitid) AS anonymouscount FROM anonymousassestmentdatahistory";
// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->execute();
// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$anonymousCount = $result['anonymouscount'];

$sql = "SELECT COUNT(applicableid) AS applicablecount FROM applicablelaw";
// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->execute();
// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$applicableCount = $result['applicablecount'];

$sql = "SELECT COUNT(violenceid) AS violencecount FROM vrc";
// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->execute();
// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$violenceCount = $result['violencecount'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
   <link rel="shortcut icon" href="../images//assets/Screenshot_2024-06-11_193516-removebg-preview.png" type="image/x-icon">
   <link rel="stylesheet" href="../css/homepage.css">
   <link rel="stylesheet" href="./HomePageCss/CM.css">
   <link rel="stylesheet" href="./HomePageCss/TableModal.css">
   <link rel="stylesheet" href="./HomePageCss/ApplicableLaws.css">
   <link rel="stylesheet" href="./HomePageCss/notificationmodal.css">
   <link rel="stylesheet" href="./HomePageCss/EmailModal.css">
   <link rel="stylesheet" href="./HomePageCss/sms.css">
   <link rel="stylesheet" href="./HomePageCss/violence.css">
   <link rel="stylesheet" href="./HomePageCss/ResidentTable.css">
   <link rel="stylesheet" href="./HomePageCss/Personalmodal.css">
   <link rel="stylesheet" href="./HomePageCss/showcasesmodal.css">
   <link rel="stylesheet" href="./HomePageCss/ViewArticleModal.css">
   <link rel="stylesheet" href="./HomePageCss/profilemod.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <title>MSWD HOMEPAGE</title>
</head>

<body>
   <div id="chat-modal" class="modal">
      <div class="modal-content">
         <p id="id" style="display: none;"></p>
         <p id="fullname" style="display: none;"></p>
         <div class="modal-header">
            <a href="#" style="text-decoration:none;">
               <h2>Chat Message</h2>
            </a>
            <span id="close-chat" class="close">&times;</span>
         </div>
         <div id="chat-messages" class="chat-messages">

         </div>
         <div class="form-container">
            <!-- <form id="chat-form" class="chat-form"> -->
            <div id="chat-form" class="chat-form">
               <input type="text" id="message" placeholder="Your message" required>
               <button type="submit" id="sendbtton" class="sendbtton" onclick="sendMessage()">Send</button>
            </div>
            <!--  </form>-->
         </div>
      </div>
   </div>
   <div id="articlemodal" class="articlemodal">
      <div class="article-modal-content">
         <span id="close-article-modal" class="close-article-modal">&times;</span>
         <h2>Create Applicable Law</h2>
         <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" placeholder="Enter the title of article..." class="articleInput" name="title">
         </div>
         <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" id="author" placeholder="Enter the author of article... " name="author" class="articleInput">
         </div>
         <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="5" placeholder="Enter the content of article..." class="articleTextArea"></textarea>
         </div>
         <button type="submit" class="submit-btn">Submit</button>
         <button class="view-btn">View Applicable Laws</button>
      </div>
   </div>
   <div id="tablemodal02" class="tablemodal02">
      <div class="table-modal-content02">
         <span id="close-modal02" class="close-modal02">&times;</span>
         <h2 style=" color:#0269b2;">Send Email and SMS</h2>
         <input type="text" id="search-input02" placeholder="Search..." class="search-bar" onkeyup="searchTable()">
         <table id="modal-table02">
            <thead>
               <tr>
                  <th class="th">ID</th>
                  <th class="th">Name</th>
                  <th class="th">Sex</th>
                  <th class="th">Type</th>
                  <th class="th">Actions</th>
               </tr>
            </thead>
            <?php
            $reportfetch = $conn->prepare("SELECT * FROM register WHERE NOT userid='$userid'");
            $reportfetch->execute();
            while ($reportdisplay = $reportfetch->fetch(PDO::FETCH_ASSOC)) {
            ?>
               <tbody>
                  <tr>
                     <td class="userid" id="userid"><?php echo $reportdisplay['userid']; ?></td>
                     <td><?php echo $reportdisplay['fullname']; ?></td>
                     <td><?php echo $reportdisplay['gender']; ?></td>
                     <td><?php echo $reportdisplay['usertype']; ?></td>
                     <td><a href="#" class="openEmail"><i class="fa-solid fa-envelope-open" style="color: #e6262c;"></i></a><a href="#" class="openSMS"><i class="fa-solid fa-comment-sms"></i></a></td>
                  </tr>
               </tbody>
            <?php
            }
            ?>
         </table>
      </div>
   </div>
   <div id="emailmodal" class="emailmodal">
      <div class="email-modal-content">
         <span id="email-close-modal" class="email-close-modal">&times;</span>
         <h2 style="color: #0269b2;">Send Email</h2>
         <form id="emailForm">
            <div id="emailview">
            </div>
            <div class="email-form-group">
               <button type="submit" class="submit-email">Send</button>
            </div>
         </form>
      </div>
   </div>
   <div id="smsmodal" class="smsmodal">
      <div class="sms-modal-content">
         <span id="sms-close-modal" class="sms-close-modal">&times;</span>
         <h2 style="color: #0269b2;">Send SMS</h2>
         <!-- <form id="smsForm">-->
         <div id="smsview"></div>
         <!-- </form> -->
      </div>
   </div>
   <div id="casesmodal" class="casesmodal">
      <div class="cases-modal-content">
         <span id="close-cases-modal" class="close-cases-modal">&times;</span>
         <h2>Violence Related Cases Form</h2>
         <form id="cases-form">
            <div class="cases-group">
               <label for="title" class="cases-label">Title:</label>
               <input type="text" class="cases-input" id="casetitle" placeholder="Enter the title of VAWC..." name="title">
            </div>
            <div class="cases-group">
               <label for="content">Content:</label>
               <textarea id="casecontent" name="content" class="cases-text" rows="5" placeholder="Enter the description of VAWC..."></textarea>
            </div>
            <button type="submit" class="cases-submit-btn">Submit</button>
            <button class="cases-view-btn">View Cases</button>
         </form>
      </div>
   </div>
   <div id="myModal" class="personal-modal">
      <div class="personal-modal-content">
      </div>
   </div>
   <div id="view-article-Modal" class="view-article-modal">
      <div class="view-article-modal-content">
         <span class="view-article-close">&times;</span>
         <h2 style="color: #0269b2;">Applicable Laws</h2>
         <input type="text" class="searchbararticle" id="searchInput" onkeyup="filterTable()" placeholder="Search for titles..">
         <table class="table" id="view-articlesTable">
            <thead>
               <tr>
                  <th class="th">ID</th>
                  <th class="th">Title</th>
                  <th class="th">Author</th>
                  <th class="th">Content</th>
                  <th class="th">Actions</th>
               </tr>
            </thead>
            <?php
            $reportfetch = $conn->prepare("SELECT * FROM applicablelaw");
            $reportfetch->execute();
            while ($reportdisplay = $reportfetch->fetch(PDO::FETCH_ASSOC)) {
            ?>
               <tbody>
                  <tr>
                     <td class="td applicableid" id="applicableid"><?php echo $reportdisplay['applicableID']; ?></td>
                     <td class="td"><?php echo $reportdisplay['title']; ?></td>
                     <td class="td"><?php echo $reportdisplay['author']; ?></td>
                     <td class="td"><?php echo $reportdisplay['content']; ?></td>
                     <td>
                        <a class="share"><i class="fas fa-edit"></i></a>
                        <a class="trash-delete"><i class="fa-solid fa-trash-can"></i></a>
                     </td>
                  </tr>
               </tbody>
            <?php
            }
            ?>
         </table>
      </div>
   </div>
   <div id="view-articlemodal" class="articlemodal" style="display: none;">
      <div class="article-modal-content">
         <span id="view-close-article-modal" class="close-article-modal">&times;</span>
         <h2>Applicable Law</h2>
         <form id="article-form">
            <div class="viewarticle">
            </div>
            <button type="submit" class="update-btn">update-btn</button>
         </form>
      </div>
   </div>
   <div id="view-cases-Modal" class="view-cases-modal">
      <div class="view-cases-modal-content">
         <span class="view-cases-close">&times;</span>
         <h2 style="color: #0269b2;">View Violence Related Cases</h2>
         <input type="text" class="searchbarcases" id="searchInputCases" onkeyup="filterTableCases()" placeholder="Search..">
         <table class="casestable" id="view-casesTable">
            <thead>
               <tr>
                  <th class="casesth">ID</th>
                  <th class="casesth">Title</th>
                  <th class="casesth">Content</th>
                  <th class="casesth">Actions</th>
               </tr>
            </thead>
            <?php
            $reportfetch = $conn->prepare("SELECT * FROM vrc");
            $reportfetch->execute();
            while ($reportdisplay = $reportfetch->fetch(PDO::FETCH_ASSOC)) {
            ?>
               <tbody>
                  <tr>
                     <td class="violenceid" id="violenceid"><?php echo $reportdisplay['violenceid']; ?></td>
                     <td class="td"><?php echo $reportdisplay['title']; ?></td>
                     <td class="td"><?php echo $reportdisplay['content']; ?></td>
                     <td>
                        <a class="share-cases"><i class="fas fa-edit"></i></a>
                        <a class="trash-delete-cases"><i class="fa-solid fa-trash-can"></i></a>
                     </td>
                  </tr>
               </tbody>
            <?php
            }
            ?>
         </table>
      </div>
   </div>
   <div id="viewcasesmodal" class="casesmodal" style="display: none;">
      <div class="cases-modal-content">
         <span id="view-close-cases-modal" class="close-cases-modal">&times;</span>
         <h2>Violence Related Case</h2>
         <form id="cases-form">
            <div class="casesview">
            </div>
            <button type="submit" class="cases-update-btn">UPDATE</button>
         </form>
      </div>
   </div>
   <div id="profileSettingsModal" class="profileSettingsmodal">
      <!-- Modal content -->
      <div class="profile-modal-content">
         <span class="profile-close">&times;</span>
         <h1 style="font-size: 20px;">Profile Settings</h1>
         <form class="profileform">
            <div id="profiledisplay"></div>
            <button class="profbtton" type="submit">Change Password</button>
         </form>
      </div>
   </div>
   <div class="container">
      <div class="topbar">
         <div class="logo">
            <h2>CRYMWACH</h2>
         </div>
         <div class="search" style="visibility: hidden;">
            <input type="text" name="search" placeholder="search here">
            <label for="search"><i class="fas fa-search"></i></label>
         </div>
         <i class="fas fa-bell" style="visibility: hidden;"></i>
         <div class="user">
            <img src="../images//assets//Screenshot_2024-06-11_193516-removebg-preview.png" alt="">
         </div>
      </div>
      <div class="sidebar">
         <ul>
            <li>
               <a href="#">
                  <i class="fas fa-th-large"></i>
                  <div>Dashboard</div>
               </a>
            </li>
            <li>
               <a class="openProfileSettings" href="#">
                  <i class="fa-solid fa-gear"></i>
                  <div>Profile Settings</div>
               </a>
            </li>
            <li>
               <a href="./ReportResident.php">
                  <i class="fa-solid fa-clipboard"></i>
                  <div>Incident Report Records</div>
               </a>
            </li>
            <!-- <li>
                  <a href="./ForwardReports.php">
                      <i class="fa-solid fa-share"></i>
                      <div>Forward Reports</div>
                  </a>
                  </li>-->
            <li>
               <a class="openChat" href="#">
                  <i class="fa-solid fa-message"></i>
                  <div>Message</div>
               </a>
            </li>
            <li>
               <a class="openArticle" href="#">
                  <i class="fa-solid fa-newspaper"></i>
                  <div>Applicable Laws Forms</div>
               </a>
            </li>
            <li>
               <a href="#" class="openNotification">
                  <i class="fa-solid fa-bell"></i>
                  <div>Notifications</div>
               </a>
            </li>
            <li>
               <a href="#" class="openCases">
                  <i class="fa-solid fa-suitcase"></i>
                  <div>Violence Related Cases</div>
               </a>
            </li>
            <li>
               <a href="./HomePageAnonymous.php">
                  <i class="fa-solid fa-user-secret"></i>
                  <div>Anonymous Report</div>
               </a>
            </li>
            <li>
               <a href="#" class="logout" onclick="PushState()">
                  <i class="fa-solid fa-door-open"></i>
                  <div>Logout</div>
               </a>
            </li>
         </ul>
      </div>
      <div class="main">
         <div class="cards">
            <div class="card">
               <div class="card-content">
                  <div class="number"><?php echo $submitCount ?></div>
                  <div class="card-name">Incident Report Records</div>
               </div>
               <div class="icon-box">
                  <i class="fa-solid fa-clipboard"></i>
               </div>
            </div>
            <div class="card">
               <div class="card-content">
                  <div class="number"><?php echo $anonymousCount ?></div>
                  <div class="card-name">Anonymous Report</div>
               </div>
               <div class="icon-box">
                  <i class="fa-solid fa-user-secret"></i>
               </div>
            </div>
            <div class="card">
               <div class="card-content">
                  <div class="number"><?php echo $applicableCount ?></div>
                  <div class="card-name">Applicable Laws</div>
               </div>
               <div class="icon-box">
                  <i class="fa-solid fa-newspaper"></i>
               </div>
            </div>
            <div class="card">
               <div class="card-content">
                  <div class="number"><?php echo $violenceCount ?></div>
                  <div class="card-name">Violence Related Cases</div>
               </div>
               <div class="icon-box">
                  <i class="fa-solid fa-suitcase"></i>
               </div>
            </div>
         </div>
         <div class="charts">
            <div class="chart">
               <input type="text" class="cd-search table-filter" id="suggestInput" data-table="order-table" placeholder="Search ID#..." onkeyup="myFunction()" />
               <table class="cd-table table" id="suggestTable">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>AGE</th>
                        <th>SEX</th>
                        <th>Civil Status</th>
                        <th>Barangay</th>
                        <th style="display: none;">ID</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $reportfetch = $conn->prepare("SELECT * FROM forwardreportdata");
                     $reportfetch->execute();
                     while ($reportdisplay = $reportfetch->fetch(PDO::FETCH_ASSOC)) {
                     ?>
                  <tbody>
                     <tr>
                        <td class="forwardid"><?php echo $reportdisplay['forwardid']; ?></td>
                        <td><?php echo $reportdisplay['user_fullname']; ?></td>
                        <td><?php echo $reportdisplay['user_age']; ?></td>
                        <td><?php echo $reportdisplay['user_gender']; ?></td>
                        <td><?php echo $reportdisplay['user_civilstatus']; ?></td>
                        <td><?php echo $reportdisplay['user_religion']; ?></td>
                        <td style="display: none;" class="userid"><?php echo $reportdisplay['user_id'] ?></td>
                        <td>
                           <a class="edit-btn"><i class="fas fa-edit"></i></a>
                           <a class="delete-btn"><i class="fa fa-trash"></i></a>
                        </td>
                     </tr>
                  </tbody>
               <?php
                     }
               ?>
               </tbody>
               </table>
            </div>
         </div>
         <!-- <div class="charts">
               <div class="chart">
                   <h2>Incident Report</h2>
                   <div>
                       <canvas id="myChart"></canvas>
                   </div>
               </div>-->
         <!--
               <div class="chart doughnut-chart">
                   <h2>Total Reports</h2>
                   <div>
                       <canvas id="doughnut"></canvas>
                   </div>
               </div>
               -->
      </div>
   </div>
   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/7.14.1-0/firebase.js"></script>
   <script src="../firebase/firebaseConfig.js"></script>
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
   <script src="../js/chats.js"></script>
   <!--<script src="../js//Chart1.js"></script>-->
   <!--<script src="../js//Chart2.js"></script>-->
   <script src="../js/searchViewArticle.js"></script>
   <script src="../js/searchViewCases.js"></script>
   <script src="../js/notificationModal.js"></script>
   <script src="../js/residentTable.js"></script>
   <script src="../js/pushStateAPI.js"></script>
   <script>
      // chatmessage search filter area
      function filterTable() {
         var input, filter, table, tr, td, i, j, txtValue;
         input = document.getElementById("search-input");
         filter = input.value.toLowerCase();
         table = document.getElementById("modal-table");
         tr = table.getElementsByTagName("tr");

         for (i = 1; i < tr.length; i++) {
            // Skip the header row
            tr[i].style.display = "none";
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
               if (td[j]) {
                  txtValue = td[j].textContent || td[j].innerText;
                  if (txtValue.toLowerCase().indexOf(filter) > -1) {
                     tr[i].style.display = "";
                     break;
                  }
               }
            }
         }
      }
      // end chatmessage search filter area

      $(".openChat").click(function() {
         document.getElementById("chat-modal").style.display = "block";
         var userid = <?php echo $_SESSION['userid'] ?>;
         var fullname = "<?php echo $fullname ?>";
         document.getElementById('id').innerText = userid;
         document.getElementById('fullname').innerText = fullname;
      });
      $(".openArticle").click(function() {
         document.getElementById("articlemodal").style.display = "block";
      });
      $(".openNotification").click(function() {
         document.getElementById("tablemodal02").style.display = "block";
      });
      $(".openEmail").click(function() {
         document.getElementById("emailmodal").style.display = "block";
         $.ajax({
            url: "../database/lawsDB.php",
            type: "POST",
            data: {
               "openEmail": true,
               userid: $(this).closest("tr").find(".userid").text(),
            },
            success: function(response) {
               console.log($(this).closest("tr").find(".userid").text());
               console.log(response);
               $("#emailview").html(response);
            },
            error: function(xhr, status, error) {
               console.error("AJAX Error: " + status + error);
            },
         });
      });
      $(".openSMS").click(function() {
         document.getElementById("smsmodal").style.display = "block";
         $.ajax({
            url: "../database/lawsDB.php",
            type: "POST",
            data: {
               "openSMS": true,
               userid: $(this).closest("tr").find(".userid").text(),
            },
            success: function(response) {
               console.log($(this).closest("tr").find(".userid").text());
               console.log(response);
               $("#smsview").html(response);
            },
            error: function(xhr, status, error) {
               console.error("AJAX Error: " + status + error);
            },
         });
      });
      $(".openCases").click(function() {
         document.getElementById("casesmodal").style.display = "block";
      });
      $(".openProfileSettings").click(function() {
         document.getElementById("profileSettingsModal").style.display = "block";
         var userid = <?php echo $_SESSION['userid']; ?>;
         $.ajax({
            url: '../database/getAccountDetails.php',
            type: 'POST',
            data: {
               "openProfileSettings": true,
               id: userid
            },
            success: function(response) {
               $('#profiledisplay').html(response);
            },
            error: function(xhr, status, error) {
               console.error('AJAX Error: ' + status + error);
            }
         });
      });
      $(".profbtton").click(function(event) {
         event.preventDefault();
         var email = $("#email").val();

         firebase.auth().sendPasswordResetEmail(email)
            .then(() => {
               Swal.fire({
                  title: "SUCESSFULLY!",
                  text: "PLEASE CHECK YOUR EMAIL!",
                  icon: "success"
               });
            })
            .catch((error) => {
               // ERROR
            });
      });
      $(".view-btn").click(function() {
         document.getElementById("view-article-Modal").style.display = "block";
      });
      $(".cases-view-btn").click(function() {
         document.getElementById("view-cases-Modal").style.display = "block";
      });
      $(".close-modal").click(function() {
         document.getElementById("tablemodal").style.display = "none";
      })
      $(".close").click(function() {
         document.getElementById("chat-modal").style.display = "none";
      })
      $(".profile-close").click(function() {
         document.getElementById("profileSettingsModal").style.display = "none";
      })
      $(".close-article-modal").click(function() {
         document.getElementById("articlemodal").style.display = "none";
      })
      $(".close-modal02").click(function() {
         document.getElementById("tablemodal02").style.display = "none";
      })
      $(".email-close-modal").click(function() {
         document.getElementById("emailmodal").style.display = "none";
      })
      $(".sms-close-modal").click(function() {
         document.getElementById("smsmodal").style.display = "none";
      })
      $(".close-cases-modal").click(function() {
         document.getElementById("casesmodal").style.display = "none";
      })
      $(".view-article-close").click(function() {
         document.getElementById("view-article-Modal").style.display = "none";
      })
      $(".view-cases-close").click(function() {
         document.getElementById("view-cases-Modal").style.display = "none";
      })
      $(".logout").click(function() {
         Swal.fire({
            title: "Are you sure?",
            text: "You want to logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Logout"
         }).then((result) => {
            if (result.isConfirmed) {
               window.location.href = "../database/logout.php";
            }
         });
      })
      $(".trash-delete").click(function() {
         Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to delete this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
         }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                  url: '../database/lawsDB.php',
                  type: 'POST',
                  data: {
                     "trashbtn": true,
                     applicableid: document.getElementById("applicableid").innerText
                  },
                  success: function(response) {},
                  error: function(xhr, status, error) {
                     console.error('AJAX Error: ' + status + error);
                  }
               }).then((result) => {
                  window.location.reload();
               }).catch((err) => {

               });
            }
         });
      });

      $(document).ready(function() {
         // delete resident and barangay sweetalert area

         $(".delete-btn").click(function(e) {
            e.preventDefault();
            var forwardid = $(this).closest('tr').find('.forwardid').text();
            Swal.fire({
               title: "Are you sure?",
               text: "You won't be able to delete this!",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Yes, delete it!"
            }).then((result) => {
               if (result.isConfirmed) {
                  $.ajax({
                     url: '../database/deleterecieveReport.php',
                     type: 'POST',
                     data: {
                        "deletebtn": true,
                        forwardid: forwardid
                     },
                     success: function(response) {
                        /*   Swal.fire({
                               title: "Deleted!",
                               text: "Your file has been deleted.",
                               icon: "success"
                           }); */

                     },
                     error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + error);
                     }
                  }).then((result) => {
                     window.location.reload();
                  }).catch((err) => {

                  });
               }
            });
         });

         // end delete resident and barangay sweetalert area

         // resident modal form area
         $(".edit-btn").click(function() {
            document.getElementById("myModal").style.display = "block";
            var forwardid = $(this).closest('tr').find('.forwardid').text();
            $.ajax({
               url: '../database/viewreportDB.php',
               type: 'post',
               data: {
                  'editbtn': true,
                  forwardid: forwardid,
               },
               success: function(response) {
                  $('.personal-modal-content').html(response);
               }
            });
         })
         // end resident modal form area
      })

      // applicable laws form area
      $(".submit-btn").click(function(e) {
         e.preventDefault();
         var title = $("#title").val();
         var author = $("#author").val();
         var description = $("#content").val();

         if (document.getElementById("title").value == "") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: 'Please enter the title!',
            });
            $("#title").focus();
            e.preventDefault();
            return false;
         } else if (document.getElementById("author").value == "") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: 'Please enter the author!',
            });
            $("#author").focus();
            e.preventDefault();
            return false;
         } else if (document.getElementById("content").value == "") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: 'Please enter the description!',
            });
            $("#content").focus();
            e.preventDefault();
            return false;
         } else {
            $.ajax({
               url: '../database/lawsDB.php',
               type: 'post',
               data: {
                  'submitbtn': true,
                  title: title,
                  author: author,
                  description: description
               },
               success: function(response) {
                  document.getElementById("title").value = "";
                  document.getElementById("author").value = "";
                  document.getElementById("content").value = "";
                  Swal.fire({
                     title: "SUCCESSFULLY!",
                     text: "ADDED Successfully.",
                     icon: "success"
                  });
                  const applicable = firebase.database().ref();
                  const applicableData = applicable.child("applicablelaw").push();
                  var key = applicableData.key;
                  applicableData.set({
                     key: key,
                     title: title,
                     author: author,
                     description: description,
                  }).then((result) => {
                     window.location.reload();
                  }).catch((err) => {
                     console.log(err);
                  });
               }
            });
         }
      })
      $(".share").click(function() {
         document.getElementById("view-articlemodal").style.display = "block";
         // document.getElementById("view-article-Modal").style.display = "none";
         var applicableid = $(this).closest('tr').find('.applicableid').text();
         $.ajax({
            url: '../database/lawsDB.php',
            type: 'post',
            data: {
               'viewbtn': true,
               applicableid: applicableid,
            },
            success: function(response) {
               $(".viewarticle").html(response);
            }
         });
      });
      $(".update-btn").click(function(e) {
         e.preventDefault();
         // var applicableid = $(this).closest('tr').find('.applicableid').text();
         var id = $("#id").text();
         var title = $("#updatetitle").val().trim();
         var author = $("#updateauthor").val().trim();
         var description = $("#updatecontent").val().trim();
         if (document.getElementById("updatetitle").value == "") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: 'Please enter the title!',
            });
            $("#updatetitle").focus();
            e.preventDefault();
            return false;
         } else if (document.getElementById("updateauthor").value == "") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: 'Please enter the author!',
            });
            $("#updateauthor").focus();
            e.preventDefault();
            return false;
         } else if (document.getElementById("updatecontent").value == "") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: 'Please enter the description!',
            });
            $("#updatecontent").focus();
            e.preventDefault();
            return false;
         } else {
            $.ajax({
               url: '../database/lawsDB.php',
               type: 'post',
               data: {
                  'updatebtn': true,
                  applicableid: id, //document.getElementById("applicableid").innerText,
                  title: title,
                  author: author,
                  description: description
               },
               success: function(response) {
                  console.log(id);
                  Swal.fire({
                     title: "SUCCESSFULLY!",
                     text: "Update Successfully.",
                     icon: "success"
                  });

               }
            });
         }
      });
      $("#view-close-article-modal").click(function(e) {
         window.location.reload();
         //  document.getElementById("view-articlemodal").style.display = "none";
         //  document.getElementById("articlemodal").style.display = "block";
      });
      // end applicable laws form area

      // violence cases area
      $(".cases-submit-btn").click(function(e) {
         e.preventDefault();
         var title = $("#casetitle").val();
         var description = $("#casecontent").val();

         if (document.getElementById("casetitle").value == "") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: 'Please enter the title!',
            });
            $("#title").focus();
            e.preventDefault();
            return false;
         } else if (document.getElementById("casecontent").value == "") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: 'Please enter the description!',
            });
            $("#content").focus();
            e.preventDefault();
            return false;
         } else {
            $.ajax({
               url: '../database/lawsDB.php',
               type: 'post',
               data: {
                  'cases-submit-btn': true,
                  title: title,
                  description: description
               },
               success: function(response) {
                  document.getElementById("casetitle").value = "";
                  document.getElementById("casecontent").value = "";
                  Swal.fire({
                     title: "SUCCESSFULLY!",
                     text: "ADDED Successfully.",
                     icon: "success"
                  });
                  const violence = firebase.database().ref();
                  const violenceData = violence.child("violencelaw").push();
                  var key = violenceData.key;
                  violenceData.set({
                     key: key,
                     title: title,
                     description: description,
                  }).then((result) => {
                     window.location.reload();
                  }).catch((err) => {
                     console.log(err);
                  });
               }
            });
         }
      })
      $(".share-cases").click(function() {
         document.getElementById("viewcasesmodal").style.display = "block";
         //   document.getElementById("view-cases-Modal").style.display = "none";
         var violenceid = $(this).closest('tr').find('.violenceid').text();
         $.ajax({
            url: '../database/lawsDB.php',
            type: 'post',
            data: {
               'sharebtncases': true,
               violenceid: violenceid,
            },
            success: function(response) {
               $(".casesview").html(response);
            }
         });
      });
      $("#view-close-cases-modal").click(function(e) {
         window.location.reload();
         //  document.getElementById("view-articlemodal").style.display = "none";
         //  document.getElementById("articlemodal").style.display = "block";
      });
      $(".cases-update-btn").click(function(e) {
         e.preventDefault();
         var title = $("#updatecasetitle").val().trim();
         var description = $("#updatecasecontent").val().trim();
         if (document.getElementById("updatecasetitle").value == "") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: 'Please enter the title!',
            });
            $("#updatecasetitle").focus();
            e.preventDefault();
            return false;
         } else if (document.getElementById("updatecasecontent").value == "") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: 'Please enter the description!',
            });
            $("#updatecasecontent").focus();
            e.preventDefault();
            return false;
         } else {
            $.ajax({
               url: '../database/lawsDB.php',
               type: 'post',
               data: {
                  'cases-update-btn': true,
                  violenceid: $("#vid").text(),
                  title: title,
                  description: description
               },
               success: function(response) {
                  console.log($("#vid").text()),
                     Swal.fire({
                        title: "SUCCESSFULLY!",
                        text: "Update Successfully.",
                        icon: "success"
                     });

               }
            });
         }
      });

      $(".trash-delete-cases").click(function() {
         Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to delete this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
         }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                  url: '../database/lawsDB.php',
                  type: 'POST',
                  data: {
                     "trash-delete-cases": true,
                     violenceid: document.getElementById("violenceid").innerText
                  },
                  success: function(response) {},
                  error: function(xhr, status, error) {
                     console.error('AJAX Error: ' + status + error);
                  }
               }).then((result) => {
                  window.location.reload();
               }).catch((err) => {

               });
            }
         });
      });
      // end violence cases area

      // sending email area
      $('.submit-email').click(function(e) {
         e.preventDefault();
         Swal.fire({
            title: 'Sending...',
            text: 'Please wait while we send your email.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
               Swal.showLoading();
            }
         });
         $.ajax({
            type: 'POST',
            url: '../api/email.php',
            data: {
               "submitEmail": true,
               "email": document.getElementById("recipient").value,
               "subject": document.getElementById("subject").value,
               "message": document.getElementById("messages").value,
            },
            success: function(response) {
               document.getElementById("subject").value = ""
               document.getElementById("messages").value = "";
               Swal.close();
               Swal.fire(
                  'Sent!',
                  'Your email has been sent successfully.',
                  'success'
               );
            },
            error: function() {
               alert('Error sending email.');
            }
         });
      });
      // end sending email area
   </script>
</body>

</html>