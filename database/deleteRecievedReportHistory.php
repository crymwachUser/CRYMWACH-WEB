<?php
include '../database/dbConnection.php';

if (isset($_POST['delete-btn'])) {

    $reportid = $_POST['reportid'];

    $query = "DELETE FROM recievedreports WHERE reportid = :reportid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":reportid" => $reportid
    ]);

    
}

?>