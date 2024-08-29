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
    <link rel="stylesheet" href="./HomePageCss/AHPage.css">
    <link rel="stylesheet" href="./HomePageCss/hpaModal.css">
    <link rel="stylesheet" href="./HomePageCss/AHomeTable.css">
    <link rel="stylesheet" href="./HomePageCss/arrecordmodal.css">
    <link rel="stylesheet" href="./HomePageCss/imagemodal.css">
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

    <div id="barangay-anonymous-Modal" class="barangay-anonymous-modal">
        <div class="barangay-anonymous-modal-content">
            <span class="barangay-anonymous-close">&times;</span>
            <h2 style="color: #0269b2;">Anonymous Report Record</h2>
            <input type="text" class="searchbarbarangay" id="searchInputbarangay" onkeyup="filterTableBarangay()" placeholder="Search..">

            <table id="barangay-anonymousTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Victims Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                $reportfetch = $conn->prepare("SELECT * FROM anonymousforwarddatahistory WHERE user_barangay=:barangay");
                $reportfetch->execute([
                    ":barangay" => $barangay
                ]);
                while ($reportdisplay = $reportfetch->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tbody>
                        <tr>
                            <td class="anonymousid"><?php echo $reportdisplay['anonymousid']; ?></td>
                            <td><?php echo $reportdisplay['user_fullname']; ?></td>
                            <td><?php echo $reportdisplay['user_victim']; ?></td>
                            <td><?php echo $reportdisplay['user_age']; ?></td>
                            <td><?php echo $reportdisplay['user_gender']; ?></td>
                            <td style="display: none;" class="userid"><?php echo $reportdisplay['user_id'] ?></td>
                            <td>

                                <a class="barangay-edit-btn"><i class="fas fa-edit"></i></a>
                                <a class="barangay-image-view-btn"><i class="fa-solid fa-images"></i></a>
                                <a class="barangay-delete-btn"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>
        </div>
    </div>

    <div id="anonymousbarangayimageModal" class="anonymousbarangayimageModal">
        <div class="anonymous-barangay-image-modal-content">
        </div>
    </div>

    <div id="barangayAnonymousRecordModal" class="barangayAnonymousRecordModal">
        <div class="anonymousmodalcontent">
        </div>
    </div>

    <div class="container">
        <div class="topbar">
            <div class="logo">
                <h2 class="anonymous" style="color: #0269b2;">ANONYMOUS REPORT</h2>
            </div>
            <div class="search" style="visibility: hidden;">
                <input type="text" name="search" placeholder="search here">
                <label for="search"><i class="fas fa-search"></i></label>
            </div>
            <i class="fas fa-bell" style="visibility: hidden;"></i>

        </div>
        <div class="sidebar">
            <ul>
                <li>
                    <a href="./barangay.php">
                        <i class="fas fa-th-large"></i>
                        <div>Dashboard</div>
                    </a>
                </li>
                <li>
                    <a style="cursor:pointer;" id="barangay-anonymous-record">
                        <i class="fa-solid fa-user-secret"></i>
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php
                        $reportfetch = $conn->prepare("SELECT * FROM anonymousreport WHERE barangay=:barangay");
                        $reportfetch->execute([
                            ":barangay" => $barangay
                        ]);
                        while ($reportdisplay = $reportfetch->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tbody>
                                <tr>
                                    <td class="anonymousid"><?php echo $reportdisplay['anonymousid']; ?></td>
                                    <td><?php echo $reportdisplay['user_fullname']; ?></td>
                                    <td><?php echo $reportdisplay['victimname']; ?></td>
                                    <td><?php echo $reportdisplay['age']; ?></td>
                                    <td><?php echo $reportdisplay['gender']; ?></td>
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
    <script src="../js/anonymousrecordtablefilter.js"></script>
    <script>
        $(document).ready(function() {


            $(".delete-btn").click(function() {
                var anonymousid = $(this).closest('tr').find('.anonymousid').text();
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
                                "delete-btn": true,
                                anonymousid: anonymousid
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
 
            $(".barangay-delete-btn").click(function(e) {
                e.preventDefault();
                var anonymousid = $(this).closest('tr').find('.anonymousid').text();
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
                                "barangay-delete-btn": true,
                                anonymousid: anonymousid
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

            $("#barangay-anonymous-record").click(function() {
                document.getElementById("barangay-anonymous-Modal").style.display = "block";
            })
            $(".barangay-edit-btn").click(function() {
                document.getElementById("barangayAnonymousRecordModal").style.display = "block";

                var anonymousid = $(this).closest('tr').find('.anonymousid').text();
                $.ajax({
                    url: '../database/anonymousviewDatahistory.php',
                    type: 'post',
                    data: {
                        'barangay-edit-btn': true,
                        anonymousid: anonymousid,
                    },
                    success: function(response) {
                        console.log(response);
                        $('.anonymousmodalcontent').html(response);
                    }
                });

            })
            $(".barangay-anonymous-close").click(function() {
                document.getElementById("barangay-anonymous-Modal").style.display = "none";
            })
            $(".barangay-image-view-btn").click(function() {
                document.getElementById("anonymousbarangayimageModal").style.display = "block";
                var anonymousid = $(this).closest('tr').find('.anonymousid').text();
                $.ajax({
                    url: '../database/anonymousviewDatahistory.php',
                    type: 'post',
                    data: {
                        'barangay-image-view-btn': true,
                        anonymousid: anonymousid,
                    },
                    success: function(response) {
                        $('.anonymous-barangay-image-modal-content').html(response);
                    }
                });

            })
            $(".edit-btn").click(function() {
                document.getElementById("myModal").style.display = "block";
                var anonymousid = $(this).closest('tr').find('.anonymousid').text();
                $.ajax({
                    url: '../database/anonymousInfoModal.php',
                    type: 'post',
                    data: {
                        'edit-btn': true,
                        anonymousid: anonymousid,
                    },
                    success: function(response) {
                        console.log(response);
                        $('.modal-content').html(response);
                    }
                });
            })
            $(".image-view").click(function() {
                document.getElementById("imageModal").style.display = "block";
                var anonymousid = $(this).closest('tr').find('.anonymousid').text();
                $.ajax({
                    url: '../database/anonymousImageView.php',
                    type: 'post',
                    data: {
                        'image-view': true,
                        anonymousid: anonymousid,
                    },
                    success: function(response) {
                        $('.image-modal-content').html(response);
                    }
                });
            })


        })
    </script>
</body>

</html>