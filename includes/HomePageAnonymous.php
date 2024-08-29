<?php

session_start();
include "../database/dbConnection.php";

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
    <link rel="stylesheet" href="./HomePageCss/AHPage.css">
    <link rel="stylesheet" href="./HomePageCss/hpaModal.css">
    <link rel="stylesheet" href="./HomePageCss/AHomeTable.css">
    <link rel="stylesheet" href="./HomePageCss/imagemodal.css">
    <link rel="stylesheet" href="./HomePageCss/arrecordmodal.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Anonymous Report</title>
</head>

<body>

    <div id="imageModal" class="imagemodal">
        <div class="image-modal-content">
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
        </div>
    </div>

    <div id="view-anonymous-Modal" class="view-anonymous-modal">
        <div class="view-anonymous-modal-content">
            <span class="view-anonymous-close">&times;</span>
            <h2 style="color: #0269b2;">Anonymous Report Record</h2>
            <input type="text" class="searchbaranonymous" id="searchInputAnonymous" onkeyup="filterTableAnonymous()" placeholder="Search..">

            <table id="view-anonymousTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Anonymous Name</th>
                        <th>Victims Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                $reportfetch = $conn->prepare("SELECT * FROM anonymousassestmentdatahistory");
                $reportfetch->execute();
                while ($reportdisplay = $reportfetch->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tbody>
                        <tr>
                            <td class="submitid"><?php echo $reportdisplay['submitid']; ?></td>
                            <td><?php echo $reportdisplay['user_fullname']; ?></td>
                            <td><?php echo $reportdisplay['user_victim']; ?></td>
                            <td><?php echo $reportdisplay['user_age']; ?></td>
                            <td><?php echo $reportdisplay['user_gender']; ?></td>
                            <td style="display: none;" class="userid"><?php echo $reportdisplay['user_id'] ?></td>
                            <td>
                                <a class="view-edit-btn"><i class="fas fa-edit"></i></a>
                                <a class="image-view-btn"><i class="fa-solid fa-images"></i></a>
                                <a class="view-delete-btn"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>
        </div>
    </div>

    <div id="anonymousRecordModal" class="anonymousmodal">
        <div class="anonymous-modal-content">
        </div>
    </div>

    <div id="anonymousimageModal" class="anonymousimagemodal">
        <div class="anonymous-image-modal-content">
        </div>
    </div>

    <div class="container">
        <div class="topbar">
            <div class="logo">
                <h2 class="anonymous" style="color: #0269b2;">ANONYMOUS REPORT</h2>
            </div>
            <div class="search" style="visibility: hidden;">
                <input type="text" name="search" placeholder="search here...">
                <label for="search"><i class="fas fa-search"></i></label>
            </div>
            <i class="fas fa-bell" style="visibility: hidden;"></i>

        </div>
        <div class="sidebar">
            <ul>
                <li>
                    <a href="./HomePage.php">
                        <i class="fas fa-th-large"></i>
                        <div>Dashboard</div>
                    </a>
                </li>
                <li>
                    <a style="cursor:pointer;" id="anonymousReport">
                        <i class="fa-solid fa-clipboard"></i>
                        <div>Anonymous Report Record</div>
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
                                <th>Victims Name</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Date Sending</th>
                            </tr>
                        </thead>

                        <?php
                        $reportfetch = $conn->prepare("SELECT * FROM anonymousforwarddata");
                        $reportfetch->execute();
                        while ($reportdisplay = $reportfetch->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tbody>
                                <tr>
                                    <td class="forwardid"><?php echo $reportdisplay['forwardid']; ?></td>
                                    <td><?php echo $reportdisplay['user_fullname']; ?></td>
                                    <td><?php echo $reportdisplay['user_victim']; ?></td>
                                    <td><?php echo $reportdisplay['user_age']; ?></td>
                                    <td><?php echo $reportdisplay['user_gender']; ?></td>
                                    <td style="display: none;" class="userid"><?php echo $reportdisplay['userid'] ?></td>
                                    <td>
                                        <a class="edit-btn"><i class="fas fa-edit"></i></a>
                                        <a class="image-view"><i class="fa-solid fa-images"></i></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/7.14.1-0/firebase.js"></script>
    <script src="../firebase/firebaseConfig.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../js/anonymousReport.js"></script>
    <script src="../js/searchAnonymousRecord.js"></script>
    <script>
        $(document).ready(function() {


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
                            url: '../database/anonymousdataDelete.php',
                            type: 'POST',
                            data: {
                                "deletebtn": true,
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


            $(".view-delete-btn").click(function(e) {
                e.preventDefault();
                var submitid = $(this).closest('tr').find('.submitid').text();
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
                            url: '../database/anonymousviewDatahistory.php',
                            type: 'POST',
                            data: {
                                "view-delete-btn": true,
                                submitid: submitid
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
            })

            $("#anonymousReport").click(function() {
                document.getElementById("view-anonymous-Modal").style.display = "block";
            })
            $(".view-anonymous-close").click(function() {
                document.getElementById("view-anonymous-Modal").style.display = "none";
            })
            $(".view-edit-btn").click(function() {
                document.getElementById("anonymousRecordModal").style.display = "block";
                var submitid = $(this).closest('tr').find('.submitid').text();
                $.ajax({
                    url: '../database/anonymousviewDatahistory.php',
                    type: 'post',
                    data: {
                        'view-edit-btn': true,
                        submitid: submitid,
                    },
                    success: function(response) {
                        console.log(response);
                        $('.anonymous-modal-content').html(response);
                    }
                });
            })
            $(".image-view-btn").click(function() {
                var submitid = $(this).closest('tr').find('.submitid').text();
                document.getElementById("anonymousimageModal").style.display = "block";
                $.ajax({
                    url: '../database/anonymousviewDatahistory.php',
                    type: 'post',
                    data: {
                        'image-view-btn': true,
                        submitid: submitid,
                    },
                    success: function(response) {
                        $('.anonymous-image-modal-content').html(response);
                    }
                });
            })
            $(".edit-btn").click(function() {
                document.getElementById("myModal").style.display = "block";
                var forwardid = $(this).closest('tr').find('.forwardid').text();
                $.ajax({
                    url: '../database/anonymousInfoModal.php',
                    type: 'post',
                    data: {
                        'editbtn': true,
                        forwardid: forwardid,
                    },
                    success: function(response) {
                        console.log(response);
                        $('.modal-content').html(response);
                    }
                });
            })
            $(".image-view").click(function() {
                document.getElementById("imageModal").style.display = "block";
                var forwardid = $(this).closest('tr').find('.forwardid').text();
                $.ajax({
                    url: '../database/anonymousImageView.php',
                    type: 'post',
                    data: {
                        'imageview': true,
                        forwardid: forwardid,
                    },
                    success: function(response) {
                        console.log(response);
                        $('.image-modal-content').html(response);
                    }
                });
            })


        })
    </script>
</body>

</html>