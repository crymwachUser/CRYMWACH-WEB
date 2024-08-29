<?php
include '../database/dbConnection.php';

if (isset($_POST['delete-btn'])) {

    $reportid = $_POST['reportid'];

    $query = "DELETE FROM report WHERE report_id = :reportid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":reportid" => $reportid
    ]);
}
else if (isset($_POST['deletebtn'])) {

    $forwardid = $_POST['forwardid'];

    $query = "DELETE FROM forwardreportdata WHERE forwardid = :forwardid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":forwardid" => $forwardid
    ]);
}
else if (isset($_POST['deletebtnResident'])) {

    $submitid = $_POST['submitid'];

    $query = "DELETE FROM assestmentdatahistory WHERE submitid = :submitid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":submitid" => $submitid
    ]);
}
?>