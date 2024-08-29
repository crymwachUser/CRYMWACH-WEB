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
    <link rel="shortcut icon" href="./HomePageCss//logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="./HomePageCss//ReportResident.css">
    <link rel="stylesheet" href="./HomePageCss//residentTable.css">
    <link rel="stylesheet" href="./HomePageCss//ResidentModal.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Forward Report</title>
</head>

<body>



    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p class="idnum" style="display: none;">1007</p>
            <form id="modalForm" method="post" action="">
                <label style="font-weight: bold;  color: #19bbd2;">FORWARD BY</label>
                <input type="text" class="text" id="name" name="name" value="Juan Dela Cruz" readonly>
                <label for="name">Name:</label>
                <label style="font-weight: bold;  color: #19bbd2;">1. PERSONAL CIRCUMSTANCES</label>
                <label for="name">Name:</label>
                <input type="text" class="text" id="name" name="name" value="John Doe" readonly>
                <label for="age">Age:</label>
                <input type="text" id="age" class="text" name="age" value="22" readonly>
                <label for="sex">Sex:</label>
                <input type="text" class="text" id="sex" name="sex" value="Male" readonly>
                <label for="age">Civil Status:</label>
                <input type="text" id="civilStatus" class="text" name="civilStatus" value="Single" readonly>
                <label for="religion">Religion:</label>
                <input type="text" class="text" id="religion" name="religion" value="Roman Catholic" readonly>
                <label for="name">Barangay</label>
                <input type="text" class="text" id="barangay" name="barangay" value="Looc" readonly>
                <label for="city">City/Municapality:</label>
                <input type="text" id="city" class="text" name="city" value="Plaridel" readonly>
                <label for="Province">Province:</label>
                <input type="text" id="province" class="text" name="province" value="Misamis Occidental" readonly>
                <label for="Educational Attainment">Educational Attainment:</label>
                <input type="text" id="educational" class="text" name="educational" value="Network Engineer Toturial" readonly>
                <label for="Highest Educational Attainment">Highest Educational Attainment:</label>
                <input type="text" class="text" id="higheducational" name="higheducational" value="Programmer Toturial" readonly>
                <label for="skilloccupation">Skill Occupation:</label>
                <input type="text" class="text" id="skillOccupation" name="skillOccupation" value="Software Developer" readonly>
                <label for="clientele">Clientele Category:</label>
                <input type="text" id="clientele" class="text" name="clientele" value="Mamords" readonly>
                <label for="beneficiary">Name of Beneficiary:</label>
                <input type="text" class="text" id="beneficiary" name="beneficiary" value="4PS" readonly>
                <label for="Household">HouseHold I.D NO.:</label>
                <input type="text" id="household" class="text" name="household" value="Purok Pag-asa-1" readonly>
                <label for="Occupation">Occupation/Profession:</label>
                <input type="text" id="Occupation" class="text" name="Occupation" value="Software Engineer" readonly>
                <label style="font-weight: bold;  color: #19bbd2;">2. INCIDENT DEATAILS</label>
                <label style="font-weight: bold;  color: #19bbd2;">A. DATE/S OF VIOLENCE COMMITTED</label>
                <label for="datereported">Date Reported:</label>
                <input type="text" id="datereport" class="text" name="datereport" value="15/05/2024" readonly>
                <label style="font-weight: bold;  color: #19bbd2;">B. NATURE OF VIOLENCE INFLICTED BY PERPETRATOR</label>
                <label>Physical:</label>
                <textarea id="physical" name="physical" readonly>lorem lorem lorem</textarea>
                <label>Sexual:</label>
                <textarea id="sexual" name="sexual" readonly>lorem lorem lorem</textarea>
                <label>Psychological:</label>
                <textarea id="psychological" name="psychological" readonly>lorem lorem lorem</textarea>
                <label>Economic Abuse:</label>
                <textarea id="economic" name="economic" readonly>lorem lorem lorem</textarea>
                <label style="font-weight: bold;  color: #19bbd2;">3. PROBLEM PRESENTED</label>
                <textarea id="problem" name="problem" readonly>lorem lorem lorem</textarea>
                <label style="font-weight: bold;  color: #19bbd2;">4. ASSESSMENT</label>
                <textarea id="assessment" name="assessment" placeholder="Enter your assessment..." required></textarea>
                <button type="submit">Submit</button>
            </form>
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
        <div class="sidebar">
            <ul>
                <li>
                    <a href="./HomePage.php">
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
                        $reportfetch = $conn->prepare("SELECT * FROM report WHERE user_barangay=:user_barangay");
                        $reportfetch->execute([
                            ":user_barangay"=>$barangay
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
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./ResidentPage.js//residentTable.js"></script>
    <script>
        $(document).ready(function() {

            // delete resident and barangay sweetalert area
            $(".delete-btn").click(function() {
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
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
         
            // end delete resident and barangay sweetalert area

            // resident modal form area
            $(".edit-btn").click(function() {
                document.getElementById("myModal").style.display = "block";
            })
            $(".close").click(function() {
                document.getElementById("myModal").style.display = "none";
            })
            // end resident modal form area


        })
    </script>
</body>

</html>