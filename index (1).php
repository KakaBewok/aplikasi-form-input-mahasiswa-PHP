<?php
$db = mysqli_connect("localhost", "root", "", "db_mhs");

$result = mysqli_query($db, "SELECT * FROM mahasiswa");

while ($row = mysqli_fetch_assoc($result)){
    var_dump($row);
}



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
        <tr>
            <td>1</td>
            <td>
                <a href="">Ubah</a> |
                <a href="">Hapus</a>
            </td>
            <td>Noprizal</td>
            <td>F1811002</td>
            <td>rizalnov667@gmail.com</td>
            <td>Ekonomi Islam</td>
            <td><img src="PAS.jpg" alt="rizal" width="70px"></td>
        </tr>
    </table>
</body>
</html>