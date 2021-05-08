<?php

    session_start();
    unset($_SESSION['ADMIN_IS_CONNECT']);
    header("Location: index.php");

?>
