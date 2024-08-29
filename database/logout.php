<?php

session_start();

if (isset($_SESSION['userid'])) {


    session_destroy();
    session_unset();

?>
    <script>
        window.location.href = "../index.php";
    </script>
<?php

} else {
?>
    <script>
        window.location.href = "../index.php";
    </script>
<?php
}

?>