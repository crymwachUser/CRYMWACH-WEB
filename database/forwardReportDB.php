<?php
// Database configuration
include '../database/dbConnection.php';
include '../database/randomNumber.php';
include "../database/dateformat.php";



try {

    if (isset($_POST['submit-btn'])) {
        // Data to be inserted

        $reportid = $_POST['reportid'];
        $user_id = $_POST['user_id'];
        $user_fullname = $_POST['user_fullname'];
        $user_age = $_POST['user_age'];
        $user_gender = $_POST['user_gender'];
        $user_civilstatus = $_POST['user_civilstatus'];
        $user_religion = $_POST['user_religion'];
        $user_barangay = $_POST['user_barangay'];
        $user_city = $_POST['user_city'];
        $user_province = $_POST['user_province'];
        $user_educational = $_POST['user_educational'];
        $user_higheducational = $_POST['user_higheducational'];
        $user_skillOccupation = $_POST['user_skillOccupation'];
        $user_clientele = $_POST['user_clientele'];
        $user_beneficiary = $_POST['user_beneficiary'];
        $user_household = $_POST['user_household'];
        $user_occupation = $_POST['user_occupation'];
        $user_datereport = $_POST['user_datereport'];
        $user_sexual = $_POST['user_sexual'];
        $user_psychological = $_POST['user_psychological'];
        $user_economic = $_POST['user_economic'];
        $user_problem = $_POST['user_problem'];
        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO forwardreportdata (forwardid, reportid, user_id, user_fullname, user_age, user_gender, user_civilstatus, user_religion, user_barangay, user_city, user_province, user_educational, user_higheducational, user_skillOccupation, user_clientele, user_beneficiary, user_household, user_occupation, user_datereport, user_sexual, user_psychological, user_economic, user_problem, dateforward, timeforward) 
    VALUES (:forwardid, :reportid, :user_id, :user_fullname, :user_age, :user_gender, :user_civilstatus, :user_religion, :user_barangay, :user_city, :user_province, :user_educational, :user_higheducational, :user_skillOccupation, :user_clientele, :user_beneficiary, :user_household, :user_occupation, :user_datereport, :user_sexual, :user_psychological, :user_economic, :user_problem, :dateforward, :timeforward)");

        // Bind the parameters to the SQL query
        $stmt->bindParam(':forwardid', $randomNumber);
        $stmt->bindParam(':reportid', $reportid);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':user_fullname', $user_fullname);
        $stmt->bindParam(':user_age', $user_age);
        $stmt->bindParam(':user_gender', $user_gender);
        $stmt->bindParam(':user_civilstatus', $user_civilstatus);
        $stmt->bindParam(':user_religion', $user_religion);
        $stmt->bindParam(':user_barangay', $user_barangay);
        $stmt->bindParam(':user_city', $user_city);
        $stmt->bindParam(':user_province', $user_province);
        $stmt->bindParam(':user_educational', $user_educational);
        $stmt->bindParam(':user_higheducational', $user_higheducational);
        $stmt->bindParam(':user_skillOccupation', $user_skillOccupation);
        $stmt->bindParam(':user_clientele', $user_clientele);
        $stmt->bindParam(':user_beneficiary', $user_beneficiary);
        $stmt->bindParam(':user_household', $user_household);
        $stmt->bindParam(':user_occupation', $user_occupation);
        $stmt->bindParam(':user_datereport', $user_datereport);
        $stmt->bindParam(':user_sexual', $user_sexual);
        $stmt->bindParam(':user_psychological', $user_psychological);
        $stmt->bindParam(':user_economic', $user_economic);
        $stmt->bindParam(':user_problem', $user_problem);
        $stmt->bindParam(':dateforward', $formattedDate);
        $stmt->bindParam(':timeforward', $formattedTime);
        // Execute the statement
        $stmt->execute();
        $stmt = $conn->prepare("INSERT INTO forwarddatahistory (forwardid, reportid, user_id, user_fullname, user_age, user_gender, user_civilstatus, user_religion, user_barangay, user_city, user_province, user_educational, user_higheducational, user_skillOccupation, user_clientele, user_beneficiary, user_household, user_occupation, user_datereport, user_sexual, user_psychological, user_economic, user_problem, dateforward, timeforward) 
        VALUES (:forwardid, :reportid, :user_id, :user_fullname, :user_age, :user_gender, :user_civilstatus, :user_religion, :user_barangay, :user_city, :user_province, :user_educational, :user_higheducational, :user_skillOccupation, :user_clientele, :user_beneficiary, :user_household, :user_occupation, :user_datereport, :user_sexual, :user_psychological, :user_economic, :user_problem, :dateforward, :timeforward)");
        $stmt->execute([
            ':forwardid' => $randomNumber,
            ':reportid' => $reportid,
            ':user_id' => $user_id,
            ':user_fullname' => $user_fullname,
            ':user_age' => $user_age,
            ':user_gender' => $user_gender,
            ':user_civilstatus' => $user_civilstatus,
            ':user_religion' => $user_religion,
            ':user_barangay' => $user_barangay,
            ':user_city' => $user_city,
            ':user_province' => $user_province,
            ':user_educational' => $user_educational,
            ':user_higheducational' => $user_higheducational,
            ':user_skillOccupation' => $user_skillOccupation,
            ':user_clientele' => $user_clientele,
            ':user_beneficiary' => $user_beneficiary,
            ':user_household' => $user_household,
            ':user_occupation' => $user_occupation,
            ':user_datereport' => $user_datereport,
            ':user_sexual' => $user_sexual,
            ':user_psychological' => $user_psychological,
            ':user_economic' => $user_economic,
            ':user_problem' => $user_problem,
            ':dateforward' => $formattedDate,
            ':timeforward' => $formattedTime,
        ]);

        $stmt = $conn->prepare("DELETE FROM report WHERE report_id=:reportid");
        $stmt->execute([
            ":reportid" => $reportid,
        ]);

        echo "Data inserted successfully.";
    } else if (isset($_POST['submitbtn'])) {
        // Data to be inserted

        $forwardid = $_POST['forwardid'];
        $reportid = $_POST['reportid'];
        $user_id = $_POST['user_id'];
        $user_fullname = $_POST['user_fullname'];
        $user_age = $_POST['user_age'];
        $user_gender = $_POST['user_gender'];
        $user_civilstatus = $_POST['user_civilstatus'];
        $user_religion = $_POST['user_religion'];
        $user_barangay = $_POST['user_barangay'];
        $user_city = $_POST['user_city'];
        $user_province = $_POST['user_province'];
        $user_educational = $_POST['user_educational'];
        $user_higheducational = $_POST['user_higheducational'];
        $user_skillOccupation = $_POST['user_skillOccupation'];
        $user_clientele = $_POST['user_clientele'];
        $user_beneficiary = $_POST['user_beneficiary'];
        $user_household = $_POST['user_household'];
        $user_occupation = $_POST['user_occupation'];
        $user_datereport = $_POST['user_datereport'];
        $user_sexual = $_POST['user_sexual'];
        $user_psychological = $_POST['user_psychological'];
        $user_economic = $_POST['user_economic'];
        $user_problem = $_POST['user_problem'];
        $dateforward = $_POST['dateforward'];
        $timeforward = $_POST['timeforward'];
        $assestment = $_POST['assestment'];
        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO assestmentData (submitid, forwardid, reportid, user_id, user_fullname, user_age, user_gender, user_civilstatus, user_religion, user_barangay, user_city, user_province, user_educational, user_higheducational, user_skillOccupation, user_clientele, user_beneficiary, user_household, user_occupation, user_datereport, user_sexual, user_psychological, user_economic, user_problem, dateforward, timeforward, datesubmit, timesubmit, assestment) 
    VALUES (:submitid, :forwardid, :reportid, :user_id, :user_fullname, :user_age, :user_gender, :user_civilstatus, :user_religion, :user_barangay, :user_city, :user_province, :user_educational, :user_higheducational, :user_skillOccupation, :user_clientele, :user_beneficiary, :user_household, :user_occupation, :user_datereport, :user_sexual, :user_psychological, :user_economic, :user_problem, :dateforward, :timeforward, :datesubmit, :timesubmit, :assestment)");

        // Bind the parameters to the SQL query
        $stmt->bindParam(':submitid', $randomNumber);
        $stmt->bindParam(':forwardid', $forwardid);
        $stmt->bindParam(':reportid', $reportid);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':user_fullname', $user_fullname);
        $stmt->bindParam(':user_age', $user_age);
        $stmt->bindParam(':user_gender', $user_gender);
        $stmt->bindParam(':user_civilstatus', $user_civilstatus);
        $stmt->bindParam(':user_religion', $user_religion);
        $stmt->bindParam(':user_barangay', $user_barangay);
        $stmt->bindParam(':user_city', $user_city);
        $stmt->bindParam(':user_province', $user_province);
        $stmt->bindParam(':user_educational', $user_educational);
        $stmt->bindParam(':user_higheducational', $user_higheducational);
        $stmt->bindParam(':user_skillOccupation', $user_skillOccupation);
        $stmt->bindParam(':user_clientele', $user_clientele);
        $stmt->bindParam(':user_beneficiary', $user_beneficiary);
        $stmt->bindParam(':user_household', $user_household);
        $stmt->bindParam(':user_occupation', $user_occupation);
        $stmt->bindParam(':user_datereport', $user_datereport);
        $stmt->bindParam(':user_sexual', $user_sexual);
        $stmt->bindParam(':user_psychological', $user_psychological);
        $stmt->bindParam(':user_economic', $user_economic);
        $stmt->bindParam(':user_problem', $user_problem);
        $stmt->bindParam(':dateforward', $dateforward);
        $stmt->bindParam(':timeforward', $timeforward);
        $stmt->bindParam(':datesubmit', $formattedDate);
        $stmt->bindParam(':timesubmit', $formattedTime);
        $stmt->bindParam(':assestment', $assestment);
        // Execute the statement
        $stmt->execute();
        $stmt = $conn->prepare("INSERT INTO assestmentdatahistory (submitid, forwardid, reportid, user_id, user_fullname, user_age, user_gender, user_civilstatus, user_religion, user_barangay, user_city, user_province, user_educational, user_higheducational, user_skillOccupation, user_clientele, user_beneficiary, user_household, user_occupation, user_datereport, user_sexual, user_psychological, user_economic, user_problem, dateforward, timeforward, datesubmit, timesubmit, assestment) 
    VALUES (:submitid, :forwardid, :reportid, :user_id, :user_fullname, :user_age, :user_gender, :user_civilstatus, :user_religion, :user_barangay, :user_city, :user_province, :user_educational, :user_higheducational, :user_skillOccupation, :user_clientele, :user_beneficiary, :user_household, :user_occupation, :user_datereport, :user_sexual, :user_psychological, :user_economic, :user_problem, :dateforward, :timeforward, :datesubmit, :timesubmit, :assestment)");
        $stmt->execute([
            ':submitid' => $randomNumber,
            ':forwardid' => $forwardid,
            ':reportid' => $reportid,
            ':user_id' => $user_id,
            ':user_fullname' => $user_fullname,
            ':user_age' => $user_age,
            ':user_gender' => $user_gender,
            ':user_civilstatus' => $user_civilstatus,
            ':user_religion' => $user_religion,
            ':user_barangay' => $user_barangay,
            ':user_city' => $user_city,
            ':user_province' => $user_province,
            ':user_educational' => $user_educational,
            ':user_higheducational' => $user_higheducational,
            ':user_skillOccupation' => $user_skillOccupation,
            ':user_clientele' => $user_clientele,
            ':user_beneficiary' => $user_beneficiary,
            ':user_household' => $user_household,
            ':user_occupation' => $user_occupation,
            ':user_datereport' => $user_datereport,
            ':user_sexual' => $user_sexual,
            ':user_psychological' => $user_psychological,
            ':user_economic' => $user_economic,
            ':user_problem' => $user_problem,
            ':dateforward' => $dateforward,
            ':timeforward' => $timeforward,
            ':datesubmit' => $formattedDate,
            ':timesubmit' => $formattedTime,
            ':assestment' => $assestment,
        ]);

        $stmt = $conn->prepare("DELETE FROM forwardreportdata WHERE forwardid=:forwardid");
        $stmt->execute([
            ":forwardid" => $forwardid,
        ]);

        echo "Data inserted successfully.";
    } else if (isset($_POST['submitanonymousbtn'])) {
        // Data to be inserted

        $forwardid = $_POST['forwardid'];
        $anonymousid = $_POST['anonymousid'];
        $user_id = $_POST['user_id'];
        $user_fullname = $_POST['user_fullname'];
        $user_victim = $_POST['user_victim'];
        $imageUrl = $_POST['imageUrl'];
        $imagefile = $_POST['imagefile'];
        $user_age = $_POST['user_age'];
        $user_gender = $_POST['user_gender'];
        $user_civilstatus = $_POST['user_civilstatus'];
        $user_religion = $_POST['user_religion'];
        $user_barangay = $_POST['user_barangay'];
        $user_city = $_POST['user_city'];
        $user_province = $_POST['user_province'];
        $user_educational = $_POST['user_educational'];
        $user_higheducational = $_POST['user_higheducational'];
        $user_skillOccupation = $_POST['user_skillOccupation'];
        $user_clientele = $_POST['user_clientele'];
        $user_beneficiary = $_POST['user_beneficiary'];
        $user_household = $_POST['user_household'];
        $user_occupation = $_POST['user_occupation'];
        $user_datereport = $_POST['user_datereport'];
        $user_sexual = $_POST['user_sexual'];
        $user_psychological = $_POST['user_psychological'];
        $user_economic = $_POST['user_economic'];
        $user_problem = $_POST['user_problem'];
        $dateforward = $_POST['dateforward'];
        $timeforward = $_POST['timeforward'];
        $assestment = $_POST['assestment'];
        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO anonymousassestmentData (submitid, forwardid, anonymousid, user_id, user_fullname, user_victim, imageUrl, imagefile, user_age, user_gender, user_civilstatus, user_religion, user_barangay, user_city, user_province, user_educational, user_higheducational, user_skillOccupation, user_clientele, user_beneficiary, user_household, user_occupation, user_datereport, user_sexual, user_psychological, user_economic, user_problem, dateforward, timeforward, datesubmit, timesubmit, assestment) 
    VALUES (:submitid, :forwardid, :anonymousid, :user_id, :user_fullname, :user_victim, :imageUrl, :imagefile, :user_age, :user_gender, :user_civilstatus, :user_religion, :user_barangay, :user_city, :user_province, :user_educational, :user_higheducational, :user_skillOccupation, :user_clientele, :user_beneficiary, :user_household, :user_occupation, :user_datereport, :user_sexual, :user_psychological, :user_economic, :user_problem, :dateforward, :timeforward, :datesubmit, :timesubmit, :assestment)");

        // Bind the parameters to the SQL query
        $stmt->bindParam(':submitid', $randomNumber);
        $stmt->bindParam(':forwardid', $forwardid);
        $stmt->bindParam(':anonymousid', $anonymousid);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':user_fullname', $user_fullname);
        $stmt->bindParam(':user_victim', $user_victim);
        $stmt->bindParam(':imageUrl', $imageUrl);
        $stmt->bindParam(':imagefile', $imagefile);
        $stmt->bindParam(':user_age', $user_age);
        $stmt->bindParam(':user_gender', $user_gender);
        $stmt->bindParam(':user_civilstatus', $user_civilstatus);
        $stmt->bindParam(':user_religion', $user_religion);
        $stmt->bindParam(':user_barangay', $user_barangay);
        $stmt->bindParam(':user_city', $user_city);
        $stmt->bindParam(':user_province', $user_province);
        $stmt->bindParam(':user_educational', $user_educational);
        $stmt->bindParam(':user_higheducational', $user_higheducational);
        $stmt->bindParam(':user_skillOccupation', $user_skillOccupation);
        $stmt->bindParam(':user_clientele', $user_clientele);
        $stmt->bindParam(':user_beneficiary', $user_beneficiary);
        $stmt->bindParam(':user_household', $user_household);
        $stmt->bindParam(':user_occupation', $user_occupation);
        $stmt->bindParam(':user_datereport', $user_datereport);
        $stmt->bindParam(':user_sexual', $user_sexual);
        $stmt->bindParam(':user_psychological', $user_psychological);
        $stmt->bindParam(':user_economic', $user_economic);
        $stmt->bindParam(':user_problem', $user_problem);
        $stmt->bindParam(':dateforward', $dateforward);
        $stmt->bindParam(':timeforward', $timeforward);
        $stmt->bindParam(':datesubmit', $formattedDate);
        $stmt->bindParam(':timesubmit', $formattedTime);
        $stmt->bindParam(':assestment', $assestment);
        // Execute the statement
        $stmt->execute();
        $stmt = $conn->prepare("INSERT INTO anonymousassestmentDataHistory (submitid, forwardid, anonymousid, user_id, user_fullname, user_victim, imageUrl, imagefile, user_age, user_gender, user_civilstatus, user_religion, user_barangay, user_city, user_province, user_educational, user_higheducational, user_skillOccupation, user_clientele, user_beneficiary, user_household, user_occupation, user_datereport, user_sexual, user_psychological, user_economic, user_problem, dateforward, timeforward, datesubmit, timesubmit, assestment) 
    VALUES (:submitid, :forwardid, :anonymousid, :user_id, :user_fullname, :user_victim, :imageUrl, :imagefile, :user_age, :user_gender, :user_civilstatus, :user_religion, :user_barangay, :user_city, :user_province, :user_educational, :user_higheducational, :user_skillOccupation, :user_clientele, :user_beneficiary, :user_household, :user_occupation, :user_datereport, :user_sexual, :user_psychological, :user_economic, :user_problem, :dateforward, :timeforward, :datesubmit, :timesubmit, :assestment)");
        $stmt->execute([
            ':submitid' => $randomNumber,
            ':forwardid' => $forwardid,
            ':anonymousid' => $anonymousid,
            ':user_id' => $user_id,
            ':user_fullname' => $user_fullname,
            ':user_victim' => $user_victim,
            ':imageUrl' => $imageUrl,
            ':imagefile' => $imagefile,
            ':user_age' => $user_age,
            ':user_gender' => $user_gender,
            ':user_civilstatus' => $user_civilstatus,
            ':user_religion' => $user_religion,
            ':user_barangay' => $user_barangay,
            ':user_city' => $user_city,
            ':user_province' => $user_province,
            ':user_educational' => $user_educational,
            ':user_higheducational' => $user_higheducational,
            ':user_skillOccupation' => $user_skillOccupation,
            ':user_clientele' => $user_clientele,
            ':user_beneficiary' => $user_beneficiary,
            ':user_household' => $user_household,
            ':user_occupation' => $user_occupation,
            ':user_datereport' => $user_datereport,
            ':user_sexual' => $user_sexual,
            ':user_psychological' => $user_psychological,
            ':user_economic' => $user_economic,
            ':user_problem' => $user_problem,
            ':dateforward' => $dateforward,
            ':timeforward' => $timeforward,
            ':datesubmit' => $formattedDate,
            ':timesubmit' => $formattedTime,
            ':assestment' => $assestment,
        ]);

        $stmt = $conn->prepare("DELETE FROM anonymousforwarddata WHERE forwardid=:forwardid");
        $stmt->execute([
            ":forwardid" => $forwardid,
        ]);

        echo "Data inserted successfully.";
    }
} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
}
