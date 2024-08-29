<?php
// Database configuration
include '../database/dbConnection.php';




try {

    if (isset($_POST['forward-btn'])) {
        // Data to be inserted
        $forwardid = $_POST['forwardid'];
        $anonymousid = $_POST['anonymousid'];
        $user_id = $_POST['user_id'];
        $forwarddate = $_POST['forwarddate'];
        $forwardtime = $_POST['forwardtime'];
        $imageurl = $_POST['imageurl'];
        $imagefile = $_POST['imagefile'];
        $user_fullname = $_POST['user_fullname'];
        $user_victim = $_POST['user_victim'];
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
        $stmt = $conn->prepare("INSERT INTO anonymousforwarddata (
        forwardid, anonymousid, user_id, forwarddate, forwardtime, imageurl, imagefile, 
        user_fullname, user_victim, user_age, user_gender, user_civilstatus, user_religion, 
        user_barangay, user_city, user_province, user_educational, user_higheducational, 
        user_skillOccupation, user_clientele, user_beneficiary, user_household, user_occupation, 
        user_datereport, user_sexual, user_psychological, user_economic, user_problem
    ) VALUES (
        :forwardid, :anonymousid, :user_id, :forwarddate, :forwardtime, :imageurl, :imagefile, 
        :user_fullname, :user_victim, :user_age, :user_gender, :user_civilstatus, :user_religion, 
        :user_barangay, :user_city, :user_province, :user_educational, :user_higheducational, 
        :user_skillOccupation, :user_clientele, :user_beneficiary, :user_household, :user_occupation, 
        :user_datereport, :user_sexual, :user_psychological, :user_economic, :user_problem
    )");

        // Bind the parameters
        $stmt->bindParam(':forwardid', $forwardid);
        $stmt->bindParam(':anonymousid', $anonymousid);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':forwarddate', $forwarddate);
        $stmt->bindParam(':forwardtime', $forwardtime);
        $stmt->bindParam(':imageurl', $imageurl);
        $stmt->bindParam(':imagefile', $imagefile);
        $stmt->bindParam(':user_fullname', $user_fullname);
        $stmt->bindParam(':user_victim', $user_victim);
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

        // Execute the statement
        $stmt->execute();

        $stmt1 = $conn->prepare("INSERT INTO anonymousforwarddatahistory (
        forwardid, anonymousid, user_id, forwarddate, forwardtime, imageurl, imagefile, 
        user_fullname, user_victim, user_age, user_gender, user_civilstatus, user_religion, 
        user_barangay, user_city, user_province, user_educational, user_higheducational, 
        user_skillOccupation, user_clientele, user_beneficiary, user_household, user_occupation, 
        user_datereport, user_sexual, user_psychological, user_economic, user_problem
    ) VALUES (
        :forwardid, :anonymousid, :user_id, :forwarddate, :forwardtime, :imageurl, :imagefile, 
        :user_fullname, :user_victim, :user_age, :user_gender, :user_civilstatus, :user_religion, 
        :user_barangay, :user_city, :user_province, :user_educational, :user_higheducational, 
        :user_skillOccupation, :user_clientele, :user_beneficiary, :user_household, :user_occupation, 
        :user_datereport, :user_sexual, :user_psychological, :user_economic, :user_problem
    )");
        // Execute the statement
        // Bind the parameters and execute the statement
        $stmt1->execute([
            ':forwardid' => $forwardid,
            ':anonymousid' => $anonymousid,
            ':user_id' => $user_id,
            ':forwarddate' => $forwarddate,
            ':forwardtime' => $forwardtime,
            ':imageurl' => $imageurl,
            ':imagefile' => $imagefile,
            ':user_fullname' => $user_fullname,
            ':user_victim' => $user_victim,
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
            ':user_problem' => $user_problem
        ]);

        $stmt2 = $conn->prepare("DELETE FROM anonymousreport WHERE anonymousid=:anonymousid");
        $stmt2->execute([
            ":anonymousid" => $anonymousid,
        ]);

        echo "Data inserted successfully.";
    }
} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
}
