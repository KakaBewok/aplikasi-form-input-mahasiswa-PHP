<?php
session_start();

//memeriksa apakah $_SESSION['login'] sudah ada/true
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    //untuk menghentikan eksekusi kode dibawahnya
    exit;
}

require 'functions.php';

//pagination (config)
//1 data yang akan ditampilkan
$dataPerHalaman = 3;
//2 jumlahHalaman = total data/data perhalaman
$totalData = count(query("SELECT * FROM mahasiswa"));
//3 fungsi ceil() berguna untuk pembulatan SELALU ke atas
$jumlahHalaman = ceil($totalData / $dataPerHalaman);
//4 halaman aktif diambil darai URL
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
//5 menentukan data awal(index awal) di halaman
//misal, halaman = 2, awalData = 3
$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;

// var_dump($jumlahHalaman);

// text query ORDER BY berguna untuk menentukan urutan menampilkan data (DESC besar ke kecil, ASC kecil ke besar kalo berdasarkan id
//limit untuk membatasi data yang ditampilkan
$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $dataPerHalaman");
// $mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC LIMIT 0, 2");

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

        <!-- 6 navigasi -->
        <!-- 8 menampilkan arrow jika halaman aktif lebih dari 1, kalo 1 or < 1 berarti tidak akan muncul arrownya -->
        <?php if($halamanAktif > 1) : ?>
            <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
        <?php endif; ?>

        <!-- 7 pengulangan untuk membuat link pagination (halaman) -->
        <?php for($i = 1; $i <= $jumlahHalaman; $i++) :?>
            <?php if($i == $halamanAktif) : ?>
                <a href="?halaman=<?= $i; ?>" style="text-decoration: none; font-weight: bold; color: black"><?= $i ?></a>
            <?php else : ?>
                <a href="?halaman=<?= $i; ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <!-- 9 arrow next page -->
        <?php if($halamanAktif < $jumlahHalaman) : ?>
            <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
        <?php endif; ?>

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
</body>
</html>