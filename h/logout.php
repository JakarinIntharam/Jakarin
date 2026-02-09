<?php
    session_start();
    unset ($_SESSION['a_id']);
    unset ($_SESSION['a_name']);

    echo"<script>";
    echo"window.location='index.php';";
    echo"</script>";
?>
