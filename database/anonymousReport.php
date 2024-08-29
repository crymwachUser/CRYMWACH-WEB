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
$anonymousid = $data['anonymousid'];
$userid = $data['userid'];
$image = $data['image_url'];
$imagefile = $data['imagefile'];
$fullname = $data['fullname'];
$victimname = $data['victimname'];
$age = $data['age'];
$gender = $data['gender'];
$barangay = $data['barangay'];
$municipal = $data['municipal'];
$status = $data['status'];
$address = $data['address'];
$religion = $data['religion'];
$province = $data['province'];
$educational_attainment = $data['educationalattainment'];
$highest_educational = $data['highesteducational'];
$skill_occupation = $data['skilloccupation'];
$client_category = $data['clientcategory'];
$name_of_benifit = $data['nameofbenefit'];
$household = $data['household'];
$occupation = $data['occupation'];
$date_reported = $data['datereported'];
$sexual = $data['sexual'];
$psychological = $data['psychological'];
$economic_abuse = $data['economicabuse'];
$problem_presented = $data['problempresented'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crymwach";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO anonymousreport (anonymousid, userid, image_url, imagefile, user_fullname, victimname, age, gender, barangay, municipal,
         status, address, religion, province, educational_attainment, highest_educational,
         skill_occupation, client_category, name_of_benefit, household,
         occupation, date_reported, sexual, psychological, economic_abuse, problem_presented) 
         VALUES (:anonymousid, :userid, :image_url, :imagefile, :user_fullname, :victimname, :age, :gender, :barangay, 
         :municipal, :status, :address, :religion,
          :province, :educational_attainment, :highest_ducational,
         :skill_occupation, :client_category, :name_of_benifit, :household,
         :occupation, :date_reported, :sexual, :psychological, :economic_abuse,
         :problem_presented)");
    // Bind parameters using bindParam
    $stmt->bindParam(':anonymousid', $anonymousid, PDO::PARAM_STR);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
    $stmt->bindParam(':image_url', $image, PDO::PARAM_STR);
    $stmt->bindParam(':imagefile', $imagefile, PDO::PARAM_STR);
    $stmt->bindParam(':user_fullname', $fullname, PDO::PARAM_STR);
    $stmt->bindParam(':victimname', $victimname, PDO::PARAM_STR);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':barangay', $barangay, PDO::PARAM_STR);
    $stmt->bindParam(':municipal', $municipal, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':religion', $religion, PDO::PARAM_STR);
    $stmt->bindParam(':province', $province, PDO::PARAM_STR);
    $stmt->bindParam(':educational_attainment', $educational_attainment, PDO::PARAM_STR);
    $stmt->bindParam(':highest_ducational', $highest_educational, PDO::PARAM_STR);
    $stmt->bindParam(':skill_occupation', $skill_occupation, PDO::PARAM_STR);
    $stmt->bindParam(':client_category', $client_category, PDO::PARAM_STR);
    $stmt->bindParam(':name_of_benifit', $name_of_benifit, PDO::PARAM_STR);
    $stmt->bindParam(':household', $household, PDO::PARAM_STR);
    $stmt->bindParam(':occupation', $occupation, PDO::PARAM_STR);
    $stmt->bindParam(':date_reported', $date_reported, PDO::PARAM_STR);
    $stmt->bindParam(':sexual', $sexual, PDO::PARAM_STR);
    $stmt->bindParam(':psychological', $psychological, PDO::PARAM_STR);
    $stmt->bindParam(':economic_abuse', $economic_abuse, PDO::PARAM_STR);
    $stmt->bindParam(':problem_presented', $problem_presented, PDO::PARAM_STR);

    $stmt->execute();
    /*
    $stmt->execute([
        ':anonymousid' => $anonymousid,
        ':user_id' => $userid,
        ':image_url' => $image,
        ':imagefile' => $imagefile,
        ':user_fullname' => $fullname,
        ':user_age' => $age,
        ':user_gender' => $gender,
        ':user_barangay' => $barangay,
        ':user_city' => $city,
        ':user_status' => $status,
        ':user_address' => $address,
        ':user_religion' => $religion,
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
    ]); */


    echo json_encode(["status" => "success"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]);
}

$conn = null;
