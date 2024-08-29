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
    $id = $data['id'];
    $fullname = $data['fullname'];
    $gender = $data['gender'];
    $barangay = $data['barangay'];
    $address = $data['address'];
    $phone = $data['phone'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crymwach";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("UPDATE register SET fullname=:fullname, gender=:gender, address=:address, barangay=:barangay, phone=:phone WHERE userid=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':barangay', $barangay, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->execute();



        echo json_encode(["status" => "success"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]);
    }


$conn = null;
