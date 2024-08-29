<?php
include '../database/dbConnection.php';

if (isset($_POST['delete-btn'])) {

    $anonymousid = $_POST['anonymousid'];

    $query = "DELETE FROM anonymousreport WHERE anonymousid = :anonymousid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":anonymousid" => $anonymousid
    ]);
} else if (isset($_POST['deletebtn'])) {

    $forwardid = $_POST['forwardid'];

    $query = "DELETE FROM anonymousforwarddata WHERE forwardid = :forwardid ";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":forwardid" => $forwardid
    ]);
}
