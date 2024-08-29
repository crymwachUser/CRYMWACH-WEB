<?php

session_start();
include "../database/dbConnection.php";
if (!isset($_SESSION['userid'])) {
    // Redirect to another page (e.g., dashboard) if logged in
    // header("Location: ../main/dashboard.php");

    header("Location: ./loginPage.php");
}

$stmt = $conn->prepare("SELECT barangay FROM register WHERE userid=:user_id");
$stmt->execute([
    ":user_id" => $_SESSION['userid'],
]);

$userinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Process the results
foreach ($userinfo as $user) {
    $barangay = $user['barangay'];
}

// SQL query to count the number of rows in a recieved reports area
$sql = "SELECT COUNT(reportid) AS recievedcount FROM recievedreports WHERE user_barangay=:barangay";

// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->execute([
    ":barangay" => $barangay
]);

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$recievedCount = $result['recievedcount'];

// SQL query to count the number of rows in a forward reports area
$sql = "SELECT COUNT(forwardid) AS forwardcount FROM forwarddatahistory WHERE user_barangay=:barangay";

// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->execute([
    ":barangay" => $barangay
]);

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$forwardCount = $result['forwardcount'];

// SQL query to count the number of rows in a anonymous reports area
$sql = "SELECT COUNT(forwardid) AS anonymouscount FROM anonymousforwarddatahistory WHERE user_barangay=:barangay";

// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->execute([
    ":barangay" => $barangay
]);

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$anonymousCount = $result['anonymouscount'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="shortcut icon" href="../images/assets/Screenshot_2024-06-11_193516-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="./HomePageCss/Barangay.css">
    <link rel="stylesheet" href="./HomePageCss/rReports.css">
    <link rel="stylesheet" href="./HomePageCss/rrTable.css">
    <link rel="stylesheet" href="./HomePageCss/RRModal.css">
    <link rel="stylesheet" href="./HomePageCss/profilemod.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>BARANGAY HOMEPAGE</title>
</head>

<body>
    <div id="myModal" class="modal">
        <div class="modal-content">
        </div>
    </div>

    <div id="profileSettingsbarangayModal" class="profileSettingsbarangaymodal">

        <!-- Modal content -->
        <div class="profile-barangay-modal-content">
            <span class="profile-barangay-close">&times;</span>
            <h1 style="font-size: 20px;">Profile Settings</h1>
            <form class="profile-barangay-form">
                <div id="display"></div>
                <button class="profilebarangaybtton" type="submit">Save updates</button>
            </form>
        </div>

    </div>

    <div class="container">
        <div class="topbar">
            <div class="logo">
                <h2 style="color:#0269b2;">BARANGAY</h2>
            </div>
            <div class="search" style="visibility: hidden;">
                <input type="text" name="search" placeholder="search here">
                <label for="search"><i class="fas fa-search"></i></label>
            </div>
            <i class="fas fa-bell" style="visibility: hidden;"></i>
            <div class="user">
                <img src="../images/assets/Screenshot_2024-06-11_193516-removebg-preview.png" alt="">
            </div>
        </div>

        <div class="sidebars">
            <ul>
                <li>
                    <a href="">
                        <i class="fas fa-th-large"></i>
                        <div>Dashboard</div>
                    </a>
                </li>
                <li>
                    <a class="openProfileBarangaySettings" href="#">
                        <i class="fa-solid fa-gear"></i>
                        <div>Profile Settings</div>
                    </a>
                </li>
                <li>
                    <a href="./receivedReports.php">
                        <i class="fa-solid fa-flag"></i>
                        <div>Received Reports</div>
                    </a>
                </li>
                <li>
                    <a href="./reportForward.php">
                        <i class="fa-solid fa-share"></i>
                        <div>Forward Reports</div>
                    </a>
                </li>
                <li>
                    <a href="./barangayAnonymous.php" class="openCases">
                        <i class="fa-solid fa-user-secret"></i>
                        <div>Anonymous Report</div>
                    </a>
                </li>
                <li>
                    <a class="logout" style="cursor: pointer;" onclick="PushState()">
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
                        <div class="number"><?php echo $recievedCount ?></div>
                        <div class="card-name">Received Reports</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-flag"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $forwardCount ?></div>
                        <div class="card-name">Forward Report</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-share"></i>
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
                                <th>Relegion</th>
                                <th style="display: none;">ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        $reportfetch = $conn->prepare("SELECT * FROM report WHERE user_barangay=:user_barangay");
                        $reportfetch->execute([
                            ":user_barangay" => $barangay
                        ]);
                        while ($reportdisplay = $reportfetch->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tbody>
                                <tr>
                                    <td class="reportid"><?php echo $reportdisplay['report_id']; ?></td>
                                    <td><?php echo $reportdisplay['user_fullname']; ?></td>
                                    <td><?php echo $reportdisplay['user_age']; ?></td>
                                    <td><?php echo $reportdisplay['user_gender']; ?></td>
                                    <td><?php echo $reportdisplay['user_status']; ?></td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/7.14.1-0/firebase.js"></script>
    <script src="../firebase/firebaseConfig.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../js//receivedTable.js"></script>
    <script src="../js/pushStateAPI.js"></script>
    <!-- <script src="../js/barangayChart1.js"></script>-->
    <!-- <script src="../js/barangayChart2.js"></script>-->
    <script>
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
        $(document).ready(function() {

            // delete resident and barangay sweetalert area
            $(".delete-btn").click(function(e) {
                e.preventDefault();
                var reportid = $(this).closest('tr').find('.reportid').text();
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
                        //   $(this).closest('tr').parent().parent().remove();
                        $.ajax({
                            url: '../database/deleterecieveReport.php',
                            type: 'POST',
                            data: {
                                "delete-btn": true,
                                reportid: reportid
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
            $(".openProfileBarangaySettings").click(function(e) {
                document.getElementById("profileSettingsbarangayModal").style.display = "block";
                e.preventDefault();
                var userid = <?php echo $_SESSION['userid']; ?>;
                $.ajax({
                    url: '../database/getAccountDetails.php',
                    type: 'POST',
                    data: {
                        id: userid
                    },
                    success: function(response) {
                        $('#display').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + error);
                    }
                });

            });
            $(".profilebarangaybtton").click(function(event) {
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
            $(".profile-barangay-close").click(function() {
                document.getElementById("profileSettingsbarangayModal").style.display = "none";
            })

        })

        // view data in modal area
        $(document).ready(function() {
            // Function to handle click event on 'View Details' button
            $('.edit-btn').click(function() {
                document.getElementById("myModal").style.display = "block";
                var reportid = $(this).closest('tr').find('.reportid').text();
                $.ajax({
                    url: '../database/viewreportDB.php',
                    type: 'post',
                    data: {
                        'edit-btn': true,
                        reportid: reportid,
                    },
                    success: function(response) {
                        $('.modal-content').html(response);
                    }
                });
            });
        });
        // end view data in modal area
    </script>
</body>

</html>