<?php
    //mencoba mendelay halaman ini selama 1 detik agar terjadi loading
    usleep(500000);

    require '../functions.php';

    //menangkap keyword dari AJAX, dari file script.js di xhr.open('get', ...)
    $keyword = $_GET['keyword'];
    //nilai dari keyword dimasukan ke query untuk jadi patokan pencarian
    $query = "SELECT * FROM mahasiswa WHERE 
                nama LIKE '%$keyword%' OR 
                nim LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
                ";

    $mahasiswa = query($query);
?>

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