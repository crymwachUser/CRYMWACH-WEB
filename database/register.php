<?php
include "../database/dbConnection.php";
header('Content-Type: application/json');

try {


    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $userid = $_POST['userid'];
        $usertype = $_POST['usertype'];
        $fullname = $_POST['fullname'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $barangay = $_POST['barangay'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Set PDO to throw exceptions on error
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL INSERT statement with placeholders
        $sql = "INSERT INTO register (userid, usertype, fullname, gender, address, barangay, phone, email, password) 
            VALUES (:userid, :usertype, :fullname, :gender, :address, :barangay, :phone, :email, :password)";
        $statement = $conn->prepare($sql);


        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Bind parameters to placeholders
        $statement->bindParam(':userid', $userid, PDO::PARAM_STR);
        $statement->bindParam(':usertype', $usertype, PDO::PARAM_STR);
        $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':address', $address, PDO::PARAM_STR);
        $statement->bindParam(':barangay', $barangay, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);


        // Execute the prepared statement
        $statement->execute();


        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    }
} catch (PDOException $e) {
    // If an error occurs, display the error message
    // echo "Insertion failed: " . $e->getMessage();
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
} catch (Exception $e) {
    // Handle other exceptions
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
