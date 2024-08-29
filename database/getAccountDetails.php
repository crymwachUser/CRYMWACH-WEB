<?php
include "./dbConnection.php";
include "./randomNumber.php";

if (isset($_POST['id'])) {
    $accountId = $_POST['id'];

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Fetch account details
        $stmt = $conn->prepare("SELECT * FROM register WHERE userid = :id");
        $stmt->bindParam(':id', $accountId, PDO::PARAM_STR);
        $stmt->execute();

        $account = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($account) {
?>
            <label for="name" class="profilebarangaylabel">Name</label>
            <input type="text" class="profilebarangayinput" id="name" name="name" value="<?php echo $account['fullname'] ?>" readonly>

            <label for="username" class="profilebarangaylabel">Gender</label>
            <input type="text" id="gender" class="profilebarangayinput" name="gender" value="<?php echo $account['gender'] ?>" readonly>

            <label for="email" class="profilebarangaylabel">email address</label>
            <input type="email" id="email" class="profilebarangayinput" name="email" value="<?php echo $account['email'] ?>" readonly>

            <label for="password" class="profilebarangaylabel">password</label>
            <input type="password" id="password" class="profilebarangayinput" value="1234567890" name="password" readonly>
        <?php
            // Add more fields as necessary
        } else {
            echo "<p>No account found.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }

    $conn = null;
} else if (isset($_POST['openProfileSettings'])) {
    $accountId = $_POST['id'];

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Fetch account details
        $stmt = $conn->prepare("SELECT * FROM register WHERE userid = :id");
        $stmt->bindParam(':id', $accountId, PDO::PARAM_STR);
        $stmt->execute();

        $account = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($account) {
        ?>
            <label for="name" class="profilelabel">Name</label>
            <input type="text" class="profileinput" id="name" name="name" value="<?php echo $account['fullname'] ?>" required>

            <label for="username" class="profilelabel">User ID</label>
            <input type="text" id="username" class="profileinput" name="username" value="<?php echo $account['userid'] ?>" required>

            <label for="email" class="profilelabel">email address</label>
            <input type="email" id="email" class="profileinput" name="email" value="<?php echo $account['email'] ?>" required>

            <label for="password" class="profilelabel">password</label>
            <input type="password" id="password" class="profileinput" value="12345678" name="password" placeholder="Password" required>
    <?php
            // Add more fields as necessary
        } else {
            echo "<p>No account found.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }

    $conn = null;
}else {
    echo "<p>Invalid request.</p>";
}
