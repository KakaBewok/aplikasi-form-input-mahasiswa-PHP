<?php
    session_start();

    //untuk menghapus/mengosongkan nilai session di server
    $_SESSION = [];
    session_unset();
    session_destroy();

    //menghapus cookie (nilainya memang dikosongkan)
    setcookie('id', '', time()-3600);
    setcookie('key', '', time()-3600);

    header("Location: login.php");
    exit;
?>