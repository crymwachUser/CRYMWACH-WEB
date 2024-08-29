<?php
include '../database/dbConnection.php';

// Check if ID parameter exists
if (isset($_POST['edit-btn'])) {
    $reportid = $_POST['reportid'];
    // Query to fetch item details based on ID
    $query = "SELECT * FROM recievedreports WHERE reportid = :reportid";
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
            <input type="text" id="civilStatus" class="text" name="civilStatus" value="<?php echo $report['user_civilstatus'] ?>" readonly>
            <label for="religion">Religion:</label>
            <input type="text" class="text" id="religion" name="religion" value="<?php echo $report['user_religion'] ?>" readonly>
            <label for="name">Barangay</label>
            <input type="text" class="text" id="barangay" name="barangay" value="<?php echo $report['user_barangay'] ?>" readonly>
            <label for="city">City/Municapality:</label>
            <input type="text" id="city" class="text" name="city" value="<?php echo $report['user_city']?>" readonly>
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
            <label style="font-weight: bold;  color: #0269b2;">B. NATURE OF VIOLENCE INFLICTED BY PERPETRATOR</label>
            <label>Sexual:</label>
            <textarea id="sexual" name="sexual" readonly><?php echo $report['user_sexual'] ?></textarea>
            <label>Psychological:</label>
            <textarea id="psychological" name="psychological" readonly><?php echo $report['user_psychological'] ?></textarea>
            <label>Economic Abuse:</label>
            <textarea id="economic" name="economic" readonly><?php echo $report['user_economic'] ?></textarea>
            <label style="font-weight: bold;  color: #0269b2;">3. PROBLEM PRESENTED</label>
            <textarea id="problem" name="problem" readonly><?php echo $report['user_problem'] ?></textarea>
            <!--<button type="submit" class="submit-btn">Forward</button>-->
        </form>
        <script>
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
} else {
    echo "Invalid request.";
}
?>