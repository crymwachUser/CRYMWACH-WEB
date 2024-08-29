<?php

include "../database/dbConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array();

    if (isset($_FILES['image']) ) {
        $errors = [];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

        $extensions = ["jpeg", "jpg", "png"];

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
        }


        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/" . $file_name);

           
            $response['status'] = "success";
            $response['message'] = "File uploaded and data saved.";
        } else {
            $response['status'] = "error";
            $response['message'] = implode(", ", $errors);
        }
    } else {
        $response['status'] = "error";
        $response['message'] = "No file uploaded or missing data.";
    }

    echo json_encode($response);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
