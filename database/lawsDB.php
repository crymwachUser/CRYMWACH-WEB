<?php
include "../database/dbConnection.php";
include "../database/randomNumber.php";


if (isset($_POST['submitbtn'])) {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['description'];
    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL insert statement
        $sql = "INSERT INTO applicablelaw (applicableID, title, author, content) VALUES (:applicableID, :title, :author, :content)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':applicableID', $randomNumber);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':content', $content);

        // Execute the statement
        $stmt->execute();

        echo "Record inserted successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
} else if (isset($_POST['viewbtn'])) {

    $applicableid = $_POST['applicableid'];
    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL insert statement
        $sql = "SELECT * FROM applicablelaw WHERE applicableID=:applicableID";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Execute the statement
        $stmt->execute([
            ':applicableID' => $applicableid
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
?>

            <p id="id" style="display: none;"><?php echo $applicableid ?></p>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="updatetitle" value="<?php echo $result['title'] ?>" placeholder="Enter the title of article..." class="articleInput" name="title">
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="updateauthor" value="<?php echo $result['author'] ?>" placeholder="Enter the author of article... " name="author" class="articleInput">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="updatecontent" name="content" rows="5" placeholder="Enter the content of article..." class="articleTextArea"><?php echo $result['content'] ?></textarea>
            </div>
        <?php
        } else {
            echo "Item not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
} else if (isset($_POST['updatebtn'])) {

    $applicableid = $_POST['applicableid'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['description'];
    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL insert statement
        $sql = "UPDATE applicablelaw SET title = :title, author = :author, content = :content WHERE applicableID = :applicableID";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Execute the statement
        $stmt->execute([
            ':applicableID' => $applicableid,
            ':title' => $title,
            ':author' => $author,
            ':content' => $content
        ]);

        echo "Record inserted successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
} else if (isset($_POST['trashbtn'])) {

    $applicableid = $_POST['applicableid'];

    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL insert statement
        $sql = "DELETE FROM applicablelaw WHERE applicableID = :applicableID";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Execute the statement
        $stmt->execute([
            ':applicableID' => $applicableid,
        ]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
} else if (isset($_POST['cases-submit-btn'])) {

    $title = $_POST['title'];
    $content = $_POST['description'];
    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL insert statement
        $sql = "INSERT INTO vrc(violenceid, title, content) VALUES (:violenceid, :title, :content)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':violenceid', $randomNumber);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);

        // Execute the statement
        $stmt->execute();

        echo "Record inserted successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
} else if (isset($_POST['sharebtncases'])) {

    $violenceid = $_POST['violenceid'];
    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL insert statement
        $sql = "SELECT * FROM vrc WHERE violenceid=:violenceid";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Execute the statement
        $stmt->execute([
            ':violenceid' => $violenceid
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
        ?>
            <p id="vid" style="display: none;"><?php echo $violenceid ?></p>
            <div class="cases-group">
                <label for="title" class="cases-label">Title:</label>
                <input type="text" class="cases-input" id="updatecasetitle" value="<?php echo $result['title'] ?>" placeholder="Enter the title of VAWC..." name="title">
            </div>
            <div class="cases-group">
                <label for="content">Content:</label>
                <textarea id="updatecasecontent" name="content" class="cases-text" rows="5" placeholder="Enter the description of VAWC..."><?php echo $result['content'] ?></textarea>
            </div>
        <?php
        } else {
            echo "Item not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
} else if (isset($_POST['cases-update-btn'])) {

    $violenceid = $_POST['violenceid'];
    $title = $_POST['title'];
    $content = $_POST['description'];
    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL insert statement
        $sql = "UPDATE vrc SET title = :title, content = :content WHERE violenceid = :violenceid";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Execute the statement
        $stmt->execute([
            ':violenceid' => $violenceid,
            ':title' => $title,
            ':content' => $content
        ]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
} else if (isset($_POST['trash-delete-cases'])) {

    $violenceid = $_POST['violenceid'];

    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL insert statement
        $sql = "DELETE FROM vrc WHERE violenceid=:violenceid";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Execute the statement
        $stmt->execute([
            ':violenceid' => $violenceid,
        ]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
} else if (isset($_POST['openEmail'])) {

    $userid = $_POST['userid'];
    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL insert statement
        $sql = "SELECT * FROM register WHERE userid=:userid";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Execute the statement
        $stmt->execute([
            ':userid' => $userid
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
        ?>
            <div class="email-form-group">
                <label for="recipient" class="label" style="color: #0269b2;">Recipient:</label>
                <input type="email" class="input-email" id="recipient" value="<?php echo $result['email'] ?>" name="Email" readonly>
            </div>
            <div class="email-form-group">
                <label for="subject" class="label" style="color: #0269b2;">Subject:</label>
                <input type="text" id="subject" class="input-email" placeholder="Enter your subject" name="Subject" required>
            </div>
            <div class="email-form-group">
                <label for="message" class="label" style="color: #0269b2;">Message:</label>
                <textarea id="messages" class="textMessage" name="Message" placeholder="Enter your email message" rows="4" required></textarea>
            </div>

        <?php
        } else {
            echo "Item not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
} else if (isset($_POST['openSMS'])) {

    $userid = $_POST['userid'];
    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL insert statement
        $sql = "SELECT * FROM register WHERE userid=:userid";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Execute the statement
        $stmt->execute([
            ':userid' => $userid
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
        ?>
            <div class="sms-form-group">
                <label for="phone" class="smslabel" style="color: #0269b2;">Phone Number:</label>
                <input type="tel" id="phone" class="smsinput" value="+63<?php echo $result['phone'] ?>" name="phone" readonly>
            </div>
            <div class="sms-form-group">
                <label for="message" class="smslabel" style="color: #0269b2;">Message:</label>
                <textarea id="msg" class="smsText" name="message" placeholder="Enter your message" rows="4" required></textarea>
            </div>
            <div class="sms-form-group">
                <button type="submit" class="sms-submit-bttn">Send</button>
            </div>

            <script>
                $(".sms-submit-bttn").click(function() {
                    Swal.fire({
                        title: 'Sending...',
                        text: 'Please wait while we send your message.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    $.ajax({
                        url: "../api/sms.php",
                        type: "POST",
                        data: {
                            "sendSMS": true,
                            phone: document.getElementById("phone").value,
                            message: document.getElementById("msg").value,
                        },
                        success: function(response) {
                            document.getElementById("msg").value = "";
                            Swal.close();
                            Swal.fire(
                                'Sent!',
                                'Your message has been sent successfully.',
                                'success'
                            );
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error: " + status + error);
                        },
                    });
                });
            </script>
<?php
        } else {
            echo "Item not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
}
