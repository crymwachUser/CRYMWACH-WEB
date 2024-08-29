<?php

session_start();
include "../database/dbConnection.php";
$stmt = $conn->prepare("SELECT barangay FROM register WHERE userid=:user_id");
$stmt->execute([
    ":user_id" => $_SESSION['userid'],
]);

$userinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Process the results
foreach ($userinfo as $user) {
    $barangay = $user['barangay'];
}
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
    <link rel="stylesheet" href="./HomePageCss/fReport.css">
    <link rel="stylesheet" href="./HomePageCss/rfTable.css">
    <link rel="stylesheet" href="./HomePageCss/reportForwardModal.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>FORWARD REPORT</title>
</head>


<body>

    <div id="myModal" class="modal">
        <div class="modal-content">
        </div>
    </div>

    <div class="container">
        <div class="topbar">
            <div class="logo">
                <h2>Forward Reports</h2>
            </div>
            <div class="search" style="visibility: hidden;">
                <input type="text" name="search" placeholder="search here">
                <label for="search"><i class="fas fa-search"></i></label>
            </div>
            <i class="fas fa-bell" style="visibility: hidden;"></i>

        </div>
        <div class="forwardsidebar">
            <ul>
                <li>
                    <a href="./barangay.php">
                        <i class="fas fa-th-large"></i>
                        <div>Dashboard</div>
                    </a>
                </li>
                <li>
                    <a style="cursor:pointer;" id="incidentReport">
                        <i class="fa-solid fa-table"></i>
                        <div>Forward Report</div>
                    </a>
                </li>

            </ul>
        </div>
        <div class="main">
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
                        $recievedReportfetch = $conn->prepare("SELECT * FROM forwarddatahistory WHERE user_barangay=:user_barangay");
                        $recievedReportfetch->execute([
                            ":user_barangay" => $barangay
                        ]);
                        while ($reportdisplay = $recievedReportfetch->fetch(PDO::FETCH_ASSOC)) {
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
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../js/forwardReportTable.js"></script>
    <script>
        $(document).ready(function() {

            // delete resident and barangay sweetalert area
              $(".delete-btn").click(function() {
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
                            url: '../database/deletereportforward.php',
                            type: 'POST',
                            data: {
                                "delete-btn": true,
                                 forwardid: forwardid
                            },
                            success: function(response) {
                                console.log(response);
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
                    url: '../database/forwardreportHistory.php',
                    type: 'post',
                    data: {
                        'edit-btn': true,
                        forwardid: forwardid,
                    },
                    success: function(response) {
                        console.log(response);
                        $('.modal-content').html(response);
                    }
                });
            })
            // end resident modal form area


        })
    </script>
</body>

</html>