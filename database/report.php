<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

$data = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid JSON"]);
    exit;
}
$reportid = $data['reportid'];
$userid = $data['userid'];
$fullname = $data['fullname'];
$age = $data['age'];
$gender = $data['gender'];
$barangay = $data['barangay'];
$city = $data['municipal'];
$status = $data['status'];
$address = $data['address'];
$religion = $data['religion'];
$province = $data['province'];
$educationalattainment = $data['educationalattainment'];
$highesteducational = $data['highesteducational'];
$skilloccupation = $data['skilloccupation'];
$clientcategory = $data['clientcategory'];
$nameofbenefit = $data['nameofbenefit'];
$household = $data['household'];
$occupation = $data['occupation'];
$datereported = $data['datereported'];
$sexual = $data['sexual'];
$psychological = $data['psychological'];
$economicabuse = $data['economicabuse'];
$problempresented = $data['problempresented'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crymwach";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO report (report_id, user_id, user_fullname, user_age, user_gender, user_barangay, user_city,
         user_status, user_address, user_religion, user_province, user_educational, user_highestEduc,
         user_skillOccupation, user_clientCategory, user_nameBenifit, user_household,
         user_occupation, user_dateReport, user_sexual, user_psychological, user_economicAbuse, user_problemPresented) 
         VALUES (:report_id, :user_id, :user_fullname, :user_age, :user_gender, :user_barangay, :user_city, :user_status, :user_address, :user_religion, :user_province, :user_educational, :user_highestEduc,
         :user_skillOccupation, :user_clientCategory, :user_nameBenifit, :user_household,
         :user_occupation, :user_dateReport, :user_sexual, :user_psychological, :user_economicAbuse,
         :user_problemPresented)");

    $stmt->bindParam(':report_id', $reportid, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $userid, PDO::PARAM_STR);
    $stmt->bindParam(':user_fullname', $fullname, PDO::PARAM_STR);
    $stmt->bindParam(':user_age', $age, PDO::PARAM_INT);
    $stmt->bindParam(':user_gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':user_barangay', $barangay, PDO::PARAM_STR);
    $stmt->bindParam(':user_city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':user_status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':user_address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':user_religion', $religion, PDO::PARAM_STR);
    $stmt->bindParam(':user_province', $province, PDO::PARAM_STR);
    $stmt->bindParam(':user_educational', $educationalattainment, PDO::PARAM_STR);
    $stmt->bindParam(':user_highestEduc', $highesteducational, PDO::PARAM_STR);
    $stmt->bindParam(':user_skillOccupation', $skilloccupation, PDO::PARAM_STR);
    $stmt->bindParam(':user_clientCategory', $clientcategory, PDO::PARAM_STR);
    $stmt->bindParam(':user_nameBenifit', $nameofbenefit, PDO::PARAM_STR);
    $stmt->bindParam(':user_household', $household, PDO::PARAM_STR);
    $stmt->bindParam(':user_occupation', $occupation, PDO::PARAM_STR);
    $stmt->bindParam(':user_dateReport', $datereported, PDO::PARAM_STR);
    $stmt->bindParam(':user_sexual', $sexual, PDO::PARAM_STR);
    $stmt->bindParam(':user_psychological', $psychological, PDO::PARAM_STR);
    $stmt->bindParam(':user_economicAbuse', $economicabuse, PDO::PARAM_STR);
    $stmt->bindParam(':user_problemPresented', $problempresented, PDO::PARAM_STR);
    $stmt->execute();


    $stmt = $conn->prepare("INSERT INTO recievedreports (reportid, user_id, user_fullname, user_age, user_gender, user_civilstatus, user_address, user_religion, user_barangay, user_city, user_province, user_educational, user_higheducational, user_skillOccupation, user_clientele, user_beneficiary, user_household, user_occupation, user_datereport, user_sexual, user_psychological, user_economic, user_problem) 
        VALUES (:reportid, :user_id, :user_fullname, :user_age, :user_gender, :user_civilstatus, :user_address, :user_religion, :user_barangay, :user_city, :user_province, :user_educational, :user_higheducational, :user_skillOccupation, :user_clientele, :user_beneficiary, :user_household, :user_occupation, :user_datereport, :user_sexual, :user_psychological, :user_economic, :user_problem)");
    $stmt->execute([
        ':reportid' => $reportid,
        ':user_id' => $userid,
        ':user_fullname' => $fullname,
        ':user_age' => $age,
        ':user_gender' => $gender,
        ':user_civilstatus' => $status,
        ':user_address' => $address,
        ':user_religion' => $religion,
        ':user_barangay' => $barangay,
        ':user_city' => $city,
        ':user_province' => $province,
        ':user_educational' => $educationalattainment,
        ':user_higheducational' => $highesteducational,
        ':user_skillOccupation' => $skilloccupation,
        ':user_clientele' => $clientcategory,
        ':user_beneficiary' => $nameofbenefit,
        ':user_household' => $household,
        ':user_occupation' => $occupation,
        ':user_datereport' => $datereported,
        ':user_sexual' => $sexual,
        ':user_psychological' => $psychological,
        ':user_economic' => $economicabuse,
        ':user_problem' => $problempresented,
    ]);


    echo json_encode(["status" => "success"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]);
}

$conn = null;
