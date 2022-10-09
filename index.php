<?php
session_start();

//memeriksa apakah $_SESSION['login'] sudah ada/true
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    //untuk menghentikan eksekusi kode dibawahnya
    exit;
}

require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

// percabangan ini akan menimpa/reassigment variabel $mahasiswa ketika tombol cari diklik
if(isset($_POST["cari"])){
    $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css" />
    <title>DAFTAR MAHASISWA</title>
</head>
<body>
    <div class="container mt-5 mb-5">
        <a class="btn btn-danger" href="logout.php" role="button">Log out</a>

        <br>

        <h1>DAFTAR MAHASISWA</h1>

        <br/>
        <br/>

        <form action="" method="post">
            <!-- properti autofocus untuk otomoatis ke input search saat laman diload -->
            <!-- properti auto complete untuk menampilkan/tidak history dari pencariannya -->
            <div class="input-group mb-3" style="width: 35%">
                <input type="text" name="keyword" placeholder="Ketikan keyword pencarian" size="25" autofocus autocomplete="off" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-primary" name="cari" type="submit" id="button-addon2">Cari</button>
            </div>
        </form>

        <a class="btn btn-primary" href="tambah.php" role="button">Tambah</a>

        <br/>
        <br/>

        <table class="table table-striped border rounded shadow-lg">
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Nama</th>
                <th>Nim</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Gambar</th>
            </tr>

            <br>

            <?php if(count($mahasiswa) === 0){
                $dataKosong = "Tidak ada data apapun.";
                echo "<h3>{$dataKosong}</h3>";
                } else {
                $mahasiswa;
                }
            ?>

            <br/>

            <?php $i = 1; ?>
            <?php foreach($mahasiswa as $mhs) : ?>
            <tr>
                <td><?= $i;?></td>
                <td>
                    <a class="btn btn-warning" href="ubah.php?id=<?= $mhs["id"]; ?>" role="button">Edit</a>
                    <!-- fungsi onclick(js) berfungsi untuk mengkonfirmasi dalam mengahapus data-->
                    <a class="btn btn-danger ms-2" href="hapus.php?id=<?= $mhs["id"]; ?>" role="button" onclick=" return confirm('Apakah anda yakin menghapus data ini?');">Hapus</a>
                </td>
                <td><?= $mhs["nama"]; ?></td>
                <td><?= $mhs["nim"]; ?></td>
                <td><?= $mhs["email"]; ?></td>
                <td><?= $mhs["jurusan"]; ?></td>
                <td><img src="img/<?= $mhs["gambar"]; ?>" alt="Foto tidak ditemukan" width="120px"></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            
        </table>
    </div>
    <script src="./bootstrap/js/bootstrap.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>