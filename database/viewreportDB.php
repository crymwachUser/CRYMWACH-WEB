<?php
include '../database/dbConnection.php';
include '../database/randomNumber.php';

// Check if ID parameter exists
if (isset($_POST['edit-btn'])) {
    $reportid = $_POST['reportid'];
    // Query to fetch item details based on ID
    $query = "SELECT * FROM report WHERE report_id = :reportid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":reportid" => $reportid
    ]);

    // Fetch data
    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display item details in modal
    if ($report) {

?>

        <span class="close">&times;</span>
        <p class="userid" style="display: none;"><?php echo $report['user_id'] ?></p>
        <form id="modalForm">
            <label style="font-weight: bold;  color: #0269b2;">1. PERSONAL CIRCUMSTANCES</label>
            <label for="name">Name:</label>
            <input type="text" class="text" id="name" name="name" value="<?php echo $report['user_fullname'] ?>" readonly>
            <label for="age">Age:</label>
            <input type="text" id="age" class="text" name="age" value="<?php echo $report['user_age'] ?>" readonly>
            <label for="sex">Sex:</label>
            <input type="text" class="text" id="sex" name="sex" value="<?php echo $report['user_gender'] ?>" readonly>
            <label for="age">Civil Status:</label>
            <input type="text" id="civilStatus" class="text" name="civilStatus" value="<?php echo $report['user_status'] ?>" readonly>
            <label for="religion">Religion:</label>
            <input type="text" class="text" id="religion" name="religion" value="<?php echo $report['user_religion'] ?>" readonly>
            <label for="name">Barangay</label>
            <input type="text" class="text" id="barangay" name="barangay" value="<?php echo $report['user_barangay'] ?>" readonly>
            <label for="city">City/Municapality:</label>
            <input type="text" id="city" class="text" name="city" value="<?php echo "Plaridel" ?>" readonly>
            <label for="Province">Province:</label>
            <input type="text" id="province" class="text" name="province" value="<?php echo $report['user_province'] ?>" readonly>
            <label for="Educational Attainment">Educational Attainment:</label>
            <input type="text" id="educational" class="text" name="educational" value="<?php echo $report['user_educational'] ?>" readonly>
            <label for="Highest Educational Attainment">Highest Educational Attainment:</label>
            <input type="text" class="text" id="higheducational" name="higheducational" value="<?php echo $report['user_highestEduc'] ?>" readonly>
            <label for="skilloccupation">Skill Occupation:</label>
            <input type="text" class="text" id="skillOccupation" name="skillOccupation" value="<?php echo $report['user_skillOccupation'] ?>" readonly>
            <label for="clientele">Clientele Category:</label>
            <input type="text" id="clientele" class="text" name="clientele" value="<?php echo $report['user_clientCategory'] ?>" readonly>
            <label for="beneficiary">Name of Beneficiary:</label>
            <input type="text" class="text" id="beneficiary" name="beneficiary" value="<?php echo $report['user_nameBenifit'] ?>" readonly>
            <label for="Household">HouseHold I.D NO.:</label>
            <input type="text" id="household" class="text" name="household" value="<?php echo $report['user_household'] ?>1" readonly>
            <label for="Occupation">Occupation/Profession:</label>
            <input type="text" id="Occupation" class="text" name="Occupation" value="<?php echo $report['user_occupation'] ?>" readonly>
            <label style="font-weight: bold;  color: #0269b2;">2. INCIDENT DEATAILS</label>
            <label style="font-weight: bold;  color: #0269b2;">A. DATE/S OF VIOLENCE COMMITTED</label>
            <label for="datereported">Date Reported:</label>
            <input type="text" id="datereport" class="text" name="datereport" value="<?php echo $report['user_dateReport'] ?>" readonly>
            <label style="font-weight: bold;  color: #0269b2;">B. NATURE OF VIOLENCE INFLICTED BY PERPETRATOR</label>
            <label>Sexual:</label>
            <textarea id="sexual" name="sexual" readonly><?php echo $report['user_sexual'] ?></textarea>
            <label>Psychological:</label>
            <textarea id="psychological" name="psychological" readonly><?php echo $report['user_psychological'] ?></textarea>
            <label>Economic Abuse:</label>
            <textarea id="economic" name="economic" readonly><?php echo $report['user_economicAbuse'] ?></textarea>
            <label style="font-weight: bold;  color: #0269b2;">3. PROBLEM PRESENTED</label>
            <textarea id="problem" name="problem" readonly><?php echo $report['user_problemPresented'] ?></textarea>
            <button type="submit" class="submit-btn">Forward</button>
        </form>
        <script>
            let currentDate = new Date();
            // Get the local date and time components
            let localDate = currentDate.toLocaleDateString(); // Local date (MM/DD/YYYY or based on browser's locale)
            let localTime = currentDate.toLocaleTimeString();
            // submit data in modal area
            $(document).ready(function() {
                // Function to handle click event on 'View Details' button
                $('.submit-btn').click(function(e) {
                    e.preventDefault();
                    document.getElementById("myModal").style.display = "none";
                    var reportid = <?php echo $report['report_id']; ?>;
                    var reportid = <?php echo $report['report_id']; ?>;
                    var user_id = <?php echo $report['user_id']; ?>;
                    var user_fullname = $("#name").val();
                    var user_age = $("#age").val();
                    var user_gender = $("#sex").val();
                    var user_civilstatus = $("#civilStatus").val();
                    var user_religion = $("#religion").val();
                    var user_barangay = $("#barangay").val();
                    var user_city = $("#city").val();
                    var user_province = $("#province").val();
                    var user_educational = $("#educational").val();
                    var user_higheducational = $("#higheducational").val();
                    var user_skillOccupation = $("#skillOccupation").val();
                    var user_clientele = $("#clientele").val();
                    var user_beneficiary = $("#beneficiary").val();
                    var user_household = $("#household").val();
                    var user_occupation = $("#Occupation").val();
                    var user_datereport = $("#datereport").val();
                    var user_sexual = $("#sexual").val();
                    var user_psychological = $("#psychological").val();
                    var user_economic = $("#economic").val();
                    var user_problem = $("#problem").val();
                    $.ajax({
                        url: '../database/forwardReportDB.php',
                        type: 'post',
                        data: {
                            "submit-btn": true,
                            reportid: reportid,
                            user_id: user_id,
                            user_fullname: user_fullname,
                            user_age: user_age,
                            user_gender: user_gender,
                            user_civilstatus: user_civilstatus,
                            user_religion: user_religion,
                            user_barangay: user_barangay,
                            user_city: user_city,
                            user_province: user_province,
                            user_educational: user_educational,
                            user_higheducational: user_higheducational,
                            user_skillOccupation: user_skillOccupation,
                            user_clientele: user_clientele,
                            user_beneficiary: user_beneficiary,
                            user_household: user_household,
                            user_occupation: user_occupation,
                            user_datereport: user_datereport,
                            user_sexual: user_sexual,
                            user_psychological: user_psychological,
                            user_economic: user_economic,
                            user_problem: user_problem
                        },
                        success: function(response) {

                            Swal.fire({
                                title: "SUCCESSFULLY!",
                                text: "Submit Successfully!",
                                icon: "success",
                            });
                            console.log(response);
                            //   $('.modal-content').html(response);
                            // submit data in firebase realtime area
                            const forw = firebase.database().ref();
                            const forward = forw.child("forwardreportdata").push();
                            var key = forward.key;
                            forward.set({
                                key: key,
                                forwardid: <?php echo $randomNumber; ?>,
                                reportid: reportid,
                                user_id: user_id,
                                user_fullname: user_fullname,
                                user_age: user_age,
                                user_gender: user_gender,
                                user_civilstatus: user_civilstatus,
                                user_religion: user_religion,
                                user_barangay: user_barangay,
                                user_city: user_city,
                                user_province: user_province,
                                user_educational: user_educational,
                                user_higheducational: user_higheducational,
                                user_skillOccupation: user_skillOccupation,
                                user_clientele: user_clientele,
                                user_beneficiary: user_beneficiary,
                                user_household: user_household,
                                user_occupation: user_occupation,
                                user_datereport: user_datereport,
                                user_sexual: user_sexual,
                                user_psychological: user_psychological,
                                user_economic: user_economic,
                                user_problem: user_problem,
                                dateforward: localDate,
                                timeforward: localTime,
                            }).then((result) => {
                                window.location.reload();
                            }).catch((err) => {
                                console.log(err);
                            });

                            const recv = firebase.database().ref();
                            const recieved = forw.child("forwarddatahistory").push();
                            var key = recieved.key;
                            recieved.set({
                                key: key,
                                forwardid: <?php echo $randomNumber; ?>,
                                reportid: reportid,
                                user_id: user_id,
                                user_fullname: user_fullname,
                                user_age: user_age,
                                user_gender: user_gender,
                                user_civilstatus: user_civilstatus,
                                user_religion: user_religion,
                                user_barangay: user_barangay,
                                user_city: user_city,
                                user_province: user_province,
                                user_educational: user_educational,
                                user_higheducational: user_higheducational,
                                user_skillOccupation: user_skillOccupation,
                                user_clientele: user_clientele,
                                user_beneficiary: user_beneficiary,
                                user_household: user_household,
                                user_occupation: user_occupation,
                                user_datereport: user_datereport,
                                user_sexual: user_sexual,
                                user_psychological: user_psychological,
                                user_economic: user_economic,
                                user_problem: user_problem,
                                dateforward: localDate,
                                timeforward: localTime,
                            }).then((result) => {
                                window.location.reload();
                            }).catch((err) => {
                                console.log(err);
                            });

                            // end submit data in firebase realtime area
                        }
                        // end submit data in modal area
                    });

                });
            });
            // close modal area
            $(".close").click(function() {
                window.location.reload();
                document.getElementById("myModal").style.display = "none";
            })
            // end close modal area
        </script>
    <?php
        // Add more fields as needed


    } else {
        echo "Item not found.";
    }
} else if (isset($_POST['editbtn'])) {
    $forwardid = $_POST['forwardid'];
    // Query to fetch item details based on ID
    $query = "SELECT * FROM forwardreportdata WHERE forwardid = :forwardid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":forwardid" => $forwardid
    ]);

    // Fetch data
    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display item details in modal
    if ($report) {

    ?>

        <span class="personal-close">&times;</span>
        <p class="idnum" style="display: none;"><?php echo $report['user_id'] ?></p>
        <form id="modalForm">
            <label style="font-weight: bold;  color: #0269b2;">1. PERSONAL CIRCUMSTANCES</label>
            <label for="name">Name:</label>
            <input type="text" class="text" id="name" name="name" value="<?php echo $report['user_fullname'] ?>" readonly>
            <label for="age">Age:</label>
            <input type="text" id="age" class="text" name="age" value="<?php echo $report['user_age'] ?>" readonly>
            <label for="sex">Sex:</label>
            <input type="text" class="text" id="sex" name="sex" value="<?php echo $report['user_gender'] ?>" readonly>
            <label for="age">Civil Status:</label>
            <input type="text" id="civilStatus" class="text" name="civilStatus" value="<?php echo $report['user_civilstatus'] ?>" readonly>
            <label for="religion">Religion:</label>
            <input type="text" class="text" id="religion" name="religion" value="<?php echo $report['user_religion'] ?>" readonly>
            <label for="name">Barangay</label>
            <input type="text" class="text" id="barangay" name="barangay" value="<?php echo $report['user_barangay'] ?>" readonly>
            <label for="city">City/Municapality:</label>
            <input type="text" id="city" class="text" name="city" value="<?php echo $report['user_city'] ?>" readonly>
            <label for="Province">Province:</label>
            <input type="text" id="province" class="text" name="province" value="<?php echo $report['user_province'] ?>" readonly>
            <label for="Educational Attainment">Educational Attainment:</label>
            <input type="text" id="educational" class="text" name="educational" value="<?php echo $report['user_educational'] ?>" readonly>
            <label for="Highest Educational Attainment">Highest Educational Attainment:</label>
            <input type="text" class="text" id="higheducational" name="higheducational" value="<?php echo $report['user_higheducational'] ?>" readonly>
            <label for="skilloccupation">Skill Occupation:</label>
            <input type="text" class="text" id="skillOccupation" name="skillOccupation" value="<?php echo $report['user_skillOccupation'] ?>" readonly>
            <label for="clientele">Clientele Category:</label>
            <input type="text" id="clientele" class="text" name="clientele" value="<?php echo $report['user_clientele'] ?>" readonly>
            <label for="beneficiary">Name of Beneficiary:</label>
            <input type="text" class="text" id="beneficiary" name="beneficiary" value="<?php echo $report['user_beneficiary'] ?>" readonly>
            <label for="Household">HouseHold I.D NO.:</label>
            <input type="text" id="household" class="text" name="household" value="<?php echo $report['user_household'] ?>1" readonly>
            <label for="Occupation">Occupation/Profession:</label>
            <input type="text" id="Occupation" class="text" name="Occupation" value="<?php echo $report['user_occupation'] ?>" readonly>
            <label style="font-weight: bold;  color: #0269b2;">2. INCIDENT DEATAILS</label>
            <label style="font-weight: bold;  color: #0269b2;">A. DATE/S OF VIOLENCE COMMITTED</label>
            <label for="datereported">Date Reported:</label>
            <input type="text" id="datereport" class="text" name="datereport" value="<?php echo $report['user_datereport'] ?>" readonly>
            <label for="dateforward">Date Forward:</label>
            <input type="text" id="dateforward" class="text" name="datereport" value="<?php echo $report['dateforward'] ?>" readonly>
            <label for="timeforward">Time Forward:</label>
            <input type="text" id="timeforward" class="text" name="datereport" value="<?php echo $report['timeforward'] ?>" readonly>
            <label style="font-weight: bold;  color: #0269b2;">B. NATURE OF VIOLENCE INFLICTED BY PERPETRATOR</label>
            <label>Sexual:</label>
            <textarea id="sexual" class="textar" name="sexual" readonly><?php echo $report['user_sexual'] ?></textarea>
            <label>Psychological:</label>
            <textarea id="psychological" class="textar" name="psychological" readonly><?php echo $report['user_psychological'] ?></textarea>
            <label>Economic Abuse:</label>
            <textarea id="economic" name="economic" class="textar" readonly><?php echo $report['user_economic'] ?></textarea>
            <label style="font-weight: bold;  color: #0269b2;">3. PROBLEM PRESENTED</label>
            <textarea id="problem" name="problem" class="textar" readonly><?php echo $report['user_problem'] ?></textarea>
            <label style="font-weight: bold;  color: #0269b2;">4. ASSESSMENT</label>
            <textarea class="textar" id="assessment" name="assessment" placeholder="Enter your assessment..." required></textarea>
            <button type="submit" class="button">Submit</button>
        </form>
        <script>
            let currentDate1 = new Date();
            // Get the local date and time components
            let localDate1 = currentDate1.toLocaleDateString(); // Local date (MM/DD/YYYY or based on browser's locale)
            let localTime1 = currentDate1.toLocaleTimeString();
            // submit data in modal area
            $(document).ready(function() {
                // Function to handle click event on 'View Details' button
                $('.button').click(function(e) {
                    e.preventDefault();


                    if (document.getElementById("assessment").value == "") {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: 'PLEASE FILL OUT THE ASSESSTMENT FIELD!',
                        });
                    } else {
                        document.getElementById("myModal").style.display = "none";
                        var forwardid = <?php echo $forwardid; ?>;
                        var reportid = <?php echo $report['reportid']; ?>;
                        var user_id = <?php echo $report['user_id']; ?>;
                        var user_fullname = $("#name").val();
                        var user_age = $("#age").val();
                        var user_gender = $("#sex").val();
                        var user_civilstatus = $("#civilStatus").val();
                        var user_religion = $("#religion").val();
                        var user_barangay = $("#barangay").val();
                        var user_city = $("#city").val();
                        var user_province = $("#province").val();
                        var user_educational = $("#educational").val();
                        var user_higheducational = $("#higheducational").val();
                        var user_skillOccupation = $("#skillOccupation").val();
                        var user_clientele = $("#clientele").val();
                        var user_beneficiary = $("#beneficiary").val();
                        var user_household = $("#household").val();
                        var user_occupation = $("#Occupation").val();
                        var user_datereport = $("#datereport").val();
                        var user_sexual = $("#sexual").val();
                        var user_psychological = $("#psychological").val();
                        var user_economic = $("#economic").val();
                        var user_problem = $("#problem").val();
                        var assestment = $("#assessment").val();
                        var dateforward = $("#dateforward").val();
                        var timeforward = $("#timeforward").val();

                        $.ajax({
                            url: '../database/forwardReportDB.php',
                            type: 'post',
                            data: {
                                "submitbtn": true,
                                forwardid: forwardid,
                                reportid: reportid,
                                user_id: user_id,
                                user_fullname: user_fullname,
                                user_age: user_age,
                                user_gender: user_gender,
                                user_civilstatus: user_civilstatus,
                                user_religion: user_religion,
                                user_barangay: user_barangay,
                                user_city: user_city,
                                user_province: user_province,
                                user_educational: user_educational,
                                user_higheducational: user_higheducational,
                                user_skillOccupation: user_skillOccupation,
                                user_clientele: user_clientele,
                                user_beneficiary: user_beneficiary,
                                user_household: user_household,
                                user_occupation: user_occupation,
                                user_datereport: user_datereport,
                                user_sexual: user_sexual,
                                user_psychological: user_psychological,
                                user_economic: user_economic,
                                user_problem: user_problem,
                                dateforward: dateforward,
                                timeforward: timeforward,
                                assestment: assestment,
                            },
                            success: function(response) {


                                Swal.fire({
                                    title: "SUCCESSFULLY!",
                                    text: "Submit Successfully!",
                                    icon: "success",
                                });
                                console.log(response);
                                //   $('.modal-content').html(response);
                                // submit data in firebase realtime area
                                const forw = firebase.database().ref();
                                const forward = forw.child("assestmentData").push();
                                var key = forward.key;
                                forward.set({
                                    key: key,
                                    submitid: <?php echo $randomNumber; ?>,
                                    forwardid: forwardid,
                                    reportid: reportid,
                                    user_id: user_id,
                                    user_fullname: user_fullname,
                                    user_age: user_age,
                                    user_gender: user_gender,
                                    user_civilstatus: user_civilstatus,
                                    user_religion: user_religion,
                                    user_barangay: user_barangay,
                                    user_city: user_city,
                                    user_province: user_province,
                                    user_educational: user_educational,
                                    user_higheducational: user_higheducational,
                                    user_skillOccupation: user_skillOccupation,
                                    user_clientele: user_clientele,
                                    user_beneficiary: user_beneficiary,
                                    user_household: user_household,
                                    user_occupation: user_occupation,
                                    user_datereport: user_datereport,
                                    user_sexual: user_sexual,
                                    user_psychological: user_psychological,
                                    user_economic: user_economic,
                                    user_problem: user_problem,
                                    dateforward: dateforward,
                                    timeforward: timeforward,
                                    assestment: assestment,
                                    datesubmit: localDate1,
                                    timesubmit: localTime1,
                                }).then((result) => {
                                    window.location.reload();
                                }).catch((err) => {
                                    console.log(err);
                                });

                                const recv = firebase.database().ref();
                                const recieved = forw.child("assestmentdatahistory").push();
                                var key = recieved.key;
                                recieved.set({
                                    key: key,
                                    submitid: <?php echo $randomNumber; ?>,
                                    forwardid: forwardid,
                                    reportid: reportid,
                                    user_id: user_id,
                                    user_fullname: user_fullname,
                                    user_age: user_age,
                                    user_gender: user_gender,
                                    user_civilstatus: user_civilstatus,
                                    user_religion: user_religion,
                                    user_barangay: user_barangay,
                                    user_city: user_city,
                                    user_province: user_province,
                                    user_educational: user_educational,
                                    user_higheducational: user_higheducational,
                                    user_skillOccupation: user_skillOccupation,
                                    user_clientele: user_clientele,
                                    user_beneficiary: user_beneficiary,
                                    user_household: user_household,
                                    user_occupation: user_occupation,
                                    user_datereport: user_datereport,
                                    user_sexual: user_sexual,
                                    user_psychological: user_psychological,
                                    user_economic: user_economic,
                                    dateforward: dateforward,
                                    timeforward: timeforward,
                                    assestment: assestment,
                                    datesubmit: localDate1,
                                    timesubmit: localTime1,
                                }).then((result) => {
                                    window.location.reload();
                                }).catch((err) => {
                                    console.log(err);
                                });

                                // end submit data in firebase realtime area
                            }
                            // end submit data in modal area
                        });
                    }

                });
            });
            // close modal area

            $(".personal-close").click(function() {
                window.location.reload();
                document.getElementById("myModal").style.display = "none";
            })
            // end close modal area
        </script>
    <?php
        // Add more fields as needed


    } else {
        echo "Item not found.";
    }
} else if (isset($_POST['editbtnResident'])) {

    $submitid = $_POST['submitid'];
    // Query to fetch item details based on ID
    $query = "SELECT * FROM assestmentdatahistory WHERE submitid = :submitid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":submitid" => $submitid
    ]);

    // Fetch data
    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($report) {

    ?>
        <span class="close">&times;</span>
        <p class="idnum" style="display: none;"><?php echo $report['user_id'] ?></p>
        <form id="modalForm">
            <label style="font-weight: bold;  color: #0269b2;">1. PERSONAL CIRCUMSTANCES</label>
            <label for="name">Name:</label>
            <input type="text" class="text" id="name" name="name" value="<?php echo $report['user_fullname'] ?>" readonly>
            <label for="age">Age:</label>
            <input type="text" id="age" class="text" name="age" value="<?php echo $report['user_age'] ?>" readonly>
            <label for="sex">Sex:</label>
            <input type="text" class="text" id="sex" name="sex" value="<?php echo $report['user_gender'] ?>" readonly>
            <label for="age">Civil Status:</label>
            <input type="text" id="civilStatus" class="text" name="civilStatus" value="<?php echo $report['user_civilstatus'] ?>" readonly>
            <label for="religion">Religion:</label>
            <input type="text" class="text" id="religion" name="religion" value="<?php echo $report['user_religion'] ?>" readonly>
            <label for="name">Barangay</label>
            <input type="text" class="text" id="barangay" name="barangay" value="<?php echo $report['user_barangay'] ?>" readonly>
            <label for="city">City/Municapality:</label>
            <input type="text" id="city" class="text" name="city" value="<?php echo $report['user_city'] ?>" readonly>
            <label for="Province">Province:</label>
            <input type="text" id="province" class="text" name="province" value="<?php echo $report['user_province'] ?>" readonly>
            <label for="Educational Attainment">Educational Attainment:</label>
            <input type="text" id="educational" class="text" name="educational" value="<?php echo $report['user_educational'] ?>" readonly>
            <label for="Highest Educational Attainment">Highest Educational Attainment:</label>
            <input type="text" class="text" id="higheducational" name="higheducational" value="<?php echo $report['user_higheducational'] ?>" readonly>
            <label for="skilloccupation">Skill Occupation:</label>
            <input type="text" class="text" id="skillOccupation" name="skillOccupation" value="<?php echo $report['user_skillOccupation'] ?>" readonly>
            <label for="clientele">Clientele Category:</label>
            <input type="text" id="clientele" class="text" name="clientele" value="<?php echo $report['user_clientele'] ?>" readonly>
            <label for="beneficiary">Name of Beneficiary:</label>
            <input type="text" class="text" id="beneficiary" name="beneficiary" value="<?php echo $report['user_beneficiary'] ?>" readonly>
            <label for="Household">HouseHold I.D NO.:</label>
            <input type="text" id="household" class="text" name="household" value="<?php echo $report['user_household'] ?>1" readonly>
            <label for="Occupation">Occupation/Profession:</label>
            <input type="text" id="Occupation" class="text" name="Occupation" value="<?php echo $report['user_occupation'] ?>" readonly>
            <label style="font-weight: bold;  color: #0269b2;">2. INCIDENT DEATAILS</label>
            <label style="font-weight: bold;  color: #0269b2;">A. DATE/S OF VIOLENCE COMMITTED</label>
            <label for="datereported">Date Reported:</label>
            <input type="text" id="datereport" class="text" name="datereport" value="<?php echo $report['user_datereport'] ?>" readonly>
            <label for="dateforward">Date Forward:</label>
            <input type="text" id="dateforward" class="text" name="datereport" value="<?php echo $report['dateforward'] ?>" readonly>
            <label for="timeforward">Time Forward:</label>
            <input type="text" id="timeforward" class="text" name="datereport" value="<?php echo $report['timeforward'] ?>" readonly>
            <label for="dateforward">Date Submit:</label>
            <input type="text" id="datesubmit" class="text" name="datereport" value="<?php echo $report['datesubmit'] ?>" readonly>
            <label for="timeforward">Time Submit:</label>
            <input type="text" id="timesubmit" class="text" name="datereport" value="<?php echo $report['timesubmit'] ?>" readonly>
            <label style="font-weight: bold;  color: #0269b2;">B. NATURE OF VIOLENCE INFLICTED BY PERPETRATOR</label>
            <label>Sexual:</label>
            <textarea id="sexual" class="textar" name="sexual" readonly><?php echo $report['user_sexual'] ?></textarea>
            <label>Psychological:</label>
            <textarea id="psychological" class="textar" name="psychological" readonly><?php echo $report['user_psychological'] ?></textarea>
            <label>Economic Abuse:</label>
            <textarea id="economic" name="economic" class="textar" readonly><?php echo $report['user_economic'] ?></textarea>
            <label style="font-weight: bold;  color: #0269b2;">3. PROBLEM PRESENTED</label>
            <textarea id="problem" name="problem" class="textar" readonly><?php echo $report['user_problem'] ?></textarea>
            <label style="font-weight: bold;  color: #0269b2;">4. ASSESSMENT</label>
            <textarea class="textar" id="assessment" name="assessment" readonly><?php echo $report['assestment'] ?></textarea>
        </form>
        <script>
            $(".close").click(function() {
                window.location.reload();
                document.getElementById("myModal").style.display = "none";
            })
        </script>
<?php
    }
} else {
    echo "Invalid request.";
}
?>