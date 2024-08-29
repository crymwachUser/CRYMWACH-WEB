<?php
session_start();

include "./dbConnection.php";

try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        //  $password = $_POST['password'];
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Prepare SQL statement to select user
        $sql = "SELECT userid, usertype FROM register WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        //  $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        //   if ($email && password_verify($inputPassword, $user['password'])) {
        if ($user) {
            $userType = $user['usertype'];
            $_SESSION['userid'] = $user['userid'];
            echo json_encode([
                "userid" => $_SESSION['userid'],
                "usertype" => $userType
            ]);
            
        }

        // } else {
        //  echo "Invalid username or password.";
        // }
        // Create a connection to the database



    } else {
        echo "Invalid request method.";
    }
} catch (PDOException $e) {
?>
    <script>
        console.log(<?php echo $e->getMessage() ?>)
    </script>
<?php
    // echo "Error: " . $e->getMessage();
}
