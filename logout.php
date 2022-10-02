<?php
    session_start();

    //untuk menghapus/mengosongkan nilai session di server
    $_SESSION = [];
    session_unset();
    session_destroy();

    header("Location: login.php");
    exit;
?>