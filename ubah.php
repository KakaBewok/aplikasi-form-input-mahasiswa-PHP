<?php
    require 'functions.php';

    // ambil data id dari url file index
    $id = $_GET["id"];

    // query data mahasiswa berdasarkan id nya (id yang ditangkap dari file index melalui url)
    $mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

    // cek tombol submit sudah ditekan atau belum
    if(isset($_POST["submit"])){
        // cek apakah data yang diinput kosong atau tidak
        if( $_POST["nama"] !== '' &&
            $_POST["nim"] !== '' &&
            $_POST["email"] !== '' &&
            $_POST["jurusan"] !== '' &&
            $_POST["gambar"] !== ''){

            // cek apakah data berhasil diubah atau tidak
            if(ubah($_POST) > 0){
                echo "<script>
                    alert('Data berhasil diubah.');
                    document.location.href = 'index.php';
                  </script>";
            } else {
                echo "<script>
                    alert('Data GAGAL diubah.');
                  </script>";
            }
        } else {
            echo "<script>
                    alert('Data tidak boleh kosong.');
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
    <title>Edit Data Mahasiswa</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Data Mahasiswa</h1>
        <!-- tambahkan tipe encoding untuk mengelola file yang akan diupload -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- form input bertype hidden yang berfungsi untuk menampilkan id mhs yang akan diubah dan ditangkap di fungsi ubah nanti -->
            <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
            
            <!-- untuk mengambil gambar lama dari database -->
            <!-- jika gambar lama gak diupdate, maka gambar lama yang akan ditampilkan, jika tidak, maka gambar baru yang akan nampil -->
            <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">

            <ul style="list-style: none">
                <li>
                    <!-- atribut value merupakan nilai default dari inputnya nanti -->
                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" id="nama" placeholder="Muhammad Andi" 
                    value="<?= $mhs["nama"]; ?>"/>
                </li>
                <li>
                    <label for="nim">NIM  :</label>
                    <input type="text" name="nim" id="nim" placeholder="G1710999" value="<?= $mhs["nim"]; ?>">
                </li>
                <li>
                    <label for="email">E-mail  :</label>
                    <input type="email" name="email" id="email" placeholder="andim@gmail.com" value="<?= $mhs["email"]; ?>"/>
                </li>
                <li>
                    <label for="jurusan">Jurusan  :</label>
                    <input type="text" name="jurusan" id="jurusan" placeholder="Sains Komunikasi" value="<?= $mhs["jurusan"]; ?>"/>
                </li>
                <li>
                    <label for="gambar">Gambar  :</label> <br/>
                    <!-- menampilkan gambar yang telah diupload -->
                    <img src="img/<?= $mhs['gambar'];?>" alt="Not Found" width="85px"> <br/>
                    <input type="file" name="gambar" id="gambar" />
                </li>
                <li>
                    <button type="submit" name="submit">UBAH</button>
                </li>
            </ul>
        </form>
    </div>
</body>
</html> 

