<?php
include '../database/dbConnection.php';

// Check if ID parameter exists
if (isset($_POST['barangay-edit-btn'])) {
    $anonymousid = $_POST['anonymousid'];
    // Query to fetch item details based on ID
    $query = "SELECT * FROM anonymousforwarddatahistory WHERE anonymousid = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":id" => $anonymousid
    ]);

    // Fetch data
    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display item details in modal
    if ($report) {

?>
        <span class="anonymousclose">&times;</span>
        <p style="color: #0269b2; margin-left:15px;">DATE RECORD: <span style="color: rgba(0, 0, 0, 0.621);"><?php echo $report['forwarddate']; ?></span></p>
        <p class="idnum" style="display: none;"><?php echo $report['forwardid']; ?></p>
        <label style="font-weight: bold;  color: #0269b2;">Anonymous Report Record</label>
        <form id="modalForm" method="post" action="">
            <label style="font-weight: bold;  color: #0269b2;">1. PERSONAL CIRCUMSTANCES</label>
            <label for="name">Anonymous Name:</label>
            <input type="text" class="text" id="reportname" name="reportname" value="<?php echo $report['user_fullname']; ?>" readonly>
            <label for="name">Victims Name:</label>
            <input type="text" class="text" id="name" name="name" value="<?php echo $report['user_victim']; ?>" readonly>
            <label for="age">Age:</label>
            <input type="text" id="age" class="text" name="age" value="<?php echo $report['user_age']; ?>" readonly>
            <label for="sex">Sex:</label>
            <input type="text" class="text" id="sex" name="sex" value="<?php echo $report['user_gender']; ?>" readonly>
            <label for="age">Civil Status:</label>
            <input type="text" id="civilStatus" class="text" name="civilStatus" value="<?php echo $report['user_civilstatus']; ?>" readonly>
            <label for="religion">Religion:</label>
            <input type="text" class="text" id="religion" name="religion" value="<?php echo $report['user_religion']; ?>" readonly>
            <label for="name">Barangay</label>
            <input type="text" class="text" id="barangay" name="barangay" value="<?php echo $report['user_barangay']; ?>" readonly>
            <label for="city">City/Municapality:</label>
            <input type="text" id="city" class="text" name="city" value="<?php echo $report['user_city']; ?>" readonly>
            <label for="Province">Province:</label>
            <input type="text" id="province" class="text" name="province" value="<?php echo $report['user_province']; ?>" readonly>
            <label style="font-weight: bold;  color: #0269b2;">2. INCIDENT DEATAILS</label>
            <label style="font-weight: bold;  color: #0269b2;">A. DATE/S OF VIOLENCE COMMITTED</label>
            <label for="datereported">Date Reported:</label>
            <input type="text" id="datereport" class="text" name="datereport" value="<?php echo $report['user_datereport']; ?>" readonly>
            <label style="font-weight: bold;  color: #0269b2;">B. NATURE OF VIOLENCE INFLICTED BY PERPETRATOR</label>
            <label>Sexual:</label>
            <textarea id="sexual" name="sexual" readonly><?php echo $report['user_sexual']; ?></textarea>
            <label>Psychological:</label>
            <textarea id="psychological" name="psychological" readonly><?php echo $report['user_psychological']; ?></textarea>
            <label>Economic Abuse:</label>
            <textarea id="economic" name="economic" readonly><?php echo $report['user_economic']; ?></textarea>
            <label style="font-weight: bold;  color: #0269b2;">3. PROBLEM PRESENTED</label>
            <textarea id="problem" name="problem" readonly><?php echo $report['user_problem']; ?></textarea>
        </form>

        <script>
            $(".anonymousclose").click(function() {
                document.getElementById("barangayAnonymousRecordModal").style.display = "none";
            })
        </script>
    <?php
        // Add more fields as needed


    } else {
        echo "Item not found.";
    }
} else if (isset($_POST['barangay-image-view-btn'])) {
    $anonymousid = $_POST['anonymousid'];
    // Query to fetch item details based on ID
    $query = "SELECT * FROM anonymousforwarddatahistory WHERE anonymousid = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":id" => $anonymousid
    ]);

    // Fetch data
    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display item details in modal
    if ($report) {

    ?>
        <img src="../uploads/<?php echo $report['imagefile']; ?>" alt="Sample Image" id="modalImage">
        <span class="anonymous-barangay-image-modal-close">&times;</span>
        <a href="../uploads/<?php echo $report['imagefile']; ?>" download class="download-icon">&#x1f4e5;</a>
        <script>
            $(".anonymous-barangay-image-modal-close").click(function() {
                document.getElementById("anonymousbarangayimageModal").style.display = "none";
            })
        </script>
    <?php
        // Add more fields as needed


    } else {
        echo "Item not found.";
    }
} else if (isset($_POST['barangay-delete-btn'])) {
    $anonymousid = $_POST['anonymousid'];
    $query = "DELETE FROM anonymousforwarddatahistory WHERE anonymousid = :anonymousid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":anonymousid" => $anonymousid
    ]);
} else if (isset($_POST['view-edit-btn'])) {
    $submitid = $_POST['submitid'];
    // Query to fetch item details based on ID
    $query = "SELECT * FROM anonymousassestmentdatahistory WHERE submitid = :submitid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":submitid" => $submitid
    ]);

    // Fetch data
    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display item details in modal
    if ($report) {

    ?>
        <span class="anonymous-close">&times;</span>
        <p style="color: #0269b2; margin-left:15px;">DATE RECORD: <span style="color: rgba(0, 0, 0, 0.621);"><?php echo $report['datesubmit']; ?></span></p>
        <p class="idnum" style="display: none;"><?php echo $report['submitid']; ?></p>
        <label style="font-weight: bold;  color: #0269b2;">Anonymous Report Record</label>
        <form id="modalForm" method="post" action="">
            <label style="font-weight: bold;  color: #0269b2;">1. PERSONAL CIRCUMSTANCES</label>
            <label for="name">Anonymous Name:</label>
            <input type="text" class="text" id="reportname" name="reportname" value="<?php echo $report['user_fullname']; ?>" readonly>
            <label for="name">Victims Name:</label>
            <input type="text" class="text" id="name" name="name" value="<?php echo $report['user_victim']; ?>" readonly>
            <label for="age">Age:</label>
            <input type="text" id="age" class="text" name="age" value="<?php echo $report['user_age']; ?>" readonly>
            <label for="sex">Sex:</label>
            <input type="text" class="text" id="sex" name="sex" value="<?php echo $report['user_gender']; ?>" readonly>
            <label for="age">Civil Status:</label>
            <input type="text" id="civilStatus" class="text" name="civilStatus" value="<?php echo $report['user_civilstatus']; ?>" readonly>
            <label for="religion">Religion:</label>
            <input type="text" class="text" id="religion" name="religion" value="<?php echo $report['user_religion']; ?>" readonly>
            <label for="name">Barangay</label>
            <input type="text" class="text" id="barangay" name="barangay" value="<?php echo $report['user_barangay']; ?>" readonly>
            <label for="city">City/Municapality:</label>
            <input type="text" id="city" class="text" name="city" value="<?php echo $report['user_city']; ?>" readonly>
            <label for="Province">Province:</label>
            <input type="text" id="province" class="text" name="province" value="<?php echo $report['user_province']; ?>" readonly>
            <label style="font-weight: bold;  color: #0269b2;">2. INCIDENT DEATAILS</label>
            <label style="font-weight: bold;  color: #0269b2;">A. DATE/S OF VIOLENCE COMMITTED</label>
            <label for="datereported">Date Reported:</label>
            <input type="text" id="datereport" class="text" name="datereport" value="<?php echo $report['user_datereport']; ?>" readonly>
            <label style="font-weight: bold;  color: #0269b2;">B. NATURE OF VIOLENCE INFLICTED BY PERPETRATOR</label>
            <label>Sexual:</label>
            <textarea id="sexual" name="sexual" readonly><?php echo $report['user_sexual']; ?></textarea>
            <label>Psychological:</label>
            <textarea id="psychological" name="psychological" readonly><?php echo $report['user_psychological']; ?></textarea>
            <label>Economic Abuse:</label>
            <textarea id="economic" name="economic" readonly><?php echo $report['user_economic']; ?></textarea>
            <label style="font-weight: bold;  color: #0269b2;">3. PROBLEM PRESENTED</label>
            <textarea id="problem" name="problem" readonly><?php echo $report['user_problem']; ?></textarea>
            <label style="font-weight: bold;  color: #0269b2;">4. ASSESSMENT</label>
            <textarea id="assessment" name="assessment" readonly><?php echo $report['assestment']; ?></textarea>
        </form>

        <script>
            $(".anonymous-close").click(function() {
                document.getElementById("anonymousRecordModal").style.display = "none";
            })
        </script>
    <?php
        // Add more fields as needed


    } else {
        echo "Item not found.";
    }
} else if (isset($_POST['image-view-btn'])) {
    $submitid = $_POST['submitid'];
    // Query to fetch item details based on ID
    $query = "SELECT * FROM anonymousassestmentdatahistory WHERE submitid = :submitid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":submitid" => $submitid
    ]);

    // Fetch data
    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display item details in modal
    if ($report) {

    ?>
        <img src="../uploads/<?php echo $report['imagefile']; ?>" alt="Sample Image" id="modalImage">
        <span class="anonymous-image-modal-close">&times;</span>
        <a href="../uploads/<?php echo $report['imagefile']; ?>" download class="download-icon">&#x1f4e5;</a>
        <script>
            $(".anonymous-image-modal-close").click(function() {
                document.getElementById("anonymousimageModal").style.display = "none";
            })
        </script>
<?php
        // Add more fields as needed


    } else {
        echo "Item not found.";
    }
} else if (isset($_POST['view-delete-btn'])) {
    $submitid = $_POST['submitid'];
    $query = "DELETE FROM anonymousassestmentdatahistory WHERE $submitid = :submitid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":submitid" => $submitid
    ]);
} else {
    echo "Invalid request.";
}



// end view image area
?>