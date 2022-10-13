<?php
use \Mpdf\Mpdf;
//untuk memanggil library
require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

//instansiasi
$mpdf = new \Mpdf\Mpdf(['tempDir' => '../../../temp']);
//untuk mencetak sesuatu ditampilan printnya

$html = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" type="text/css" href="./style/style.css" />
                <link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css" />
                <title>Daftar Mahasiswa</title>
            </head>
            <body>
                <h1>Daftar Mahasiswa</h1>
                <table border="1" class="table table-striped border rounded shadow-lg" cellpadding="10">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Nim</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Gambar</th>
                    </tr>';

        $i = 1;
        foreach($mahasiswa as $row){
            $html .= '<tr>
                        <td>'. $i++ .' </td>
                        <td>'. $row["nama"] .' </td>
                        <td>'. $row["nim"] .' </td>
                        <td>'. $row["email"] .' </td>
                        <td>'. $row["jurusan"] .' </td>
                        <td> <img src="img/'. $row["gambar"] .'" width="80px"/> </td>
                      </tr>';
        }

$html .=        '</table>
            <script src="./bootstrap/js/bootstrap.js"></script> 
            </body>
        </html>';


$mpdf->WriteHTML($html);

//parameter ini fungsinya untuk memberi nama file ketika didownload
//kalo INLINEnya diganti DOWNLOAD itu akan menghilangkan proses previewnya
//\Mpdf\output\Destination::INLINE bisa disingkat jadi 'I' saja
$mpdf->Output('daftar-mahasiswa.pdf', 'I');

?>

