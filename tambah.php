<?php
    session_start();

    //memeriksa apakah $_SESSION['login'] sudah ada/true
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
        //untuk menghentikan eksekusi kode dibawahnya
        exit;
    }
    
    require 'functions.php';

    // cek tombol submit sudah ditekan atau belum
    if(isset($_POST["submit"])){
        // cek apakah data yang diinput kosong atau tidak
        if( $_POST["nama"] !== '' &&
            $_POST["nim"] !== '' &&
            $_POST["email"] !== '' &&
            $_POST["jurusan"] !== ''){


            // cek apakah data berhasil ditambahkan atau tidak
            if(tambah($_POST) > 0){
                echo "<script>
                    alert('Data berhasil disimpan.');
                    document.location.href = 'index.php';
                  </script>";
            } else {
                echo "<script>
                    alert('Data GAGAL disimpan.');
                  </script>";
            }
        } else {
            echo "<script>
                    alert('Data tidak boleh kosong, silahkan isi data dengan lengkap.');
                  </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        ul li {
            margin: 10px;
        }
        li input {
            margin-left: 6px;
        }
    </style>
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Data Mahasiswa</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <ul style="list-style: none">
                <li>
                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" id="nama" placeholder="Muhammad Andi"/>
                </li>
                <li>
                    <label for="nim">NIM  :</label>
                    <input type="text" name="nim" id="nim" placeholder="G1710999" >
                </li>
                <li>
                    <label for="email">E-mail  :</label>
                    <input type="email" name="email" id="email" placeholder="andim@gmail.com"/>
                </li>
                <li>
                    <label for="jurusan">Jurusan  :</label>
                    <input type="text" name="jurusan" id="jurusan" placeholder="Sains Komunikasi"/>
                </li>
                <li>
                    <label for="gambar">Gambar  :</label>
                    <input type="file" name="gambar" id="gambar" placeholder="andin.jpg"/>
                </li>
                <li>
                    <button type="submit" name="submit">TAMBAH</button>
                </li>
            </ul>
        </form>
    </div>
</body>
</html> 

