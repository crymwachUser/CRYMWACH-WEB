<?php
include '../database/dbConnection.php';

// Check if ID parameter exists
if (isset($_POST['image-view'])) {
    $anonymousid = $_POST['anonymousid'];
    // Query to fetch item details based on ID
    $query = "SELECT * FROM anonymousreport WHERE anonymousid = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":id" => $anonymousid
    ]);

    // Fetch data
    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display item details in modal
    if ($report) {

?>
        <img src="../uploads/<?php echo $report['imagefile']; ?>" alt="Sample Image" id="modalImage">
        <span class="image-modal-close">&times;</span>
        <a href="../uploads/<?php echo $report['imagefile']; ?>" download class="download-icon">&#x1f4e5;</a>

        <script>
            $(".image-modal-close").click(function() {
                document.getElementById("imageModal").style.display = "none";
            })
        </script>
    <?php
        // Add more fields as needed


    } else {
        echo "Item not found.";
    }
} else if (isset($_POST['imageview'])) {
    $forwardid = $_POST['forwardid'];
    // Query to fetch item details based on ID
    $query = "SELECT * FROM anonymousforwarddata WHERE forwardid = :forwardid";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":forwardid" => $forwardid
    ]);

    // Fetch data
    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display item details in modal
    if ($report) {

    ?>
        <img src="../uploads/<?php echo $report['imagefile']; ?>" alt="Sample Image" id="modalImage">
        <span class="image-modal-close">&times;</span>
        <a href="../uploads/<?php echo $report['imagefile']; ?>" download class="download-icon">&#x1f4e5;</a>

        <script>
            $(".image-modal-close").click(function() {
                document.getElementById("imageModal").style.display = "none";
            })
        </script>
<?php
        // Add more fields as needed


    } else {
        echo "Item not found.";
    }
} else {
    echo "Invalid request.";
}
?>