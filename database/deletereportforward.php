<?php
include '../database/dbConnection.php';

if (isset($_POST['delete-btn'])) {

    $forwardid = $_POST['forwardid'];

    $query = "DELETE FROM forwarddatahistory WHERE forwardid = :forwardid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":forwardid" => $forwardid
    ]);

    
}

?>