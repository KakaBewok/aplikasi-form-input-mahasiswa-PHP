<?php
require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAFTAR MAHASISWA</title>
</head>
<body>
    <h1>DAFTAR MAHASISWA</h1>

    <a href="tambah.php">Tambah Data</a>

    <br/>
    <br/>
    
    <table border="1" cellpadding="7" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Nama</th>
            <th>Nim</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Gambar</th>
        </tr>

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
                <a href="ubah.php?id=<?= $mhs["id"]; ?>">Ubah</a> |
                <!-- fungsi onclick(js) berfungsi untuk mengkonfirmasi dalam mengahapus data-->
                <a href="hapus.php?id=<?= $mhs["id"]; ?>" onclick=" return confirm('Apakah anda yakin menghapus data ini?');">Hapus</a>
            </td>
            <td><?= $mhs["nama"]; ?></td>
            <td><?= $mhs["nim"]; ?></td>
            <td><?= $mhs["email"]; ?></td>
            <td><?= $mhs["jurusan"]; ?></td>
            <td><img src="<?= $mhs["gambar"]; ?>" alt="Foto tidak ditemukan" width="100px"></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        
    </table>
</body>
</html>