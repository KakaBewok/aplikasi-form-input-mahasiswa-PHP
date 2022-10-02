<?php
    session_start();

    //memeriksa apakah $_SESSION['login'] sudah ada/true
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
        //untuk menghentikan eksekusi kode dibawahnya
        exit;
    }

    require 'functions.php';

    $id = $_GET["id"];

    if(hapus($id) > 0){
        echo "<script>
                    alert('Data berhasil dihapus.');
                    document.location.href = 'index.php';
                  </script>";
    } else {
        echo "<script>
                    alert('Data gagal dihapus.');
                    document.location.href = 'index.php';
                  </script>";
    }
?>