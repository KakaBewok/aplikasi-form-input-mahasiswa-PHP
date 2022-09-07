<?php
// variabel koneksi database
$conn_db = mysqli_connect("localhost", "root", "", "db_mhs"); //menghubungkan localhost dengan mysql

// fungsi untuk melakukan query menampilkan seluruh data mahasiswa
function query($query){

    global $conn_db;

    $result = mysqli_query($conn_db, $query);

    $rows = [];

    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}
// fungsi untuk menambahkan data
function tambah($data){
    global $conn_db;

    // data inputan dimasukan ke dalam variabel dan difilter dengan method
    $nama = htmlSpecialChars($data["nama"]);
    $nim = htmlSpecialChars($data["nim"]);
    $email = htmlSpecialChars($data["email"]);
    $jurusan = htmlSpecialChars($data["jurusan"]);
    $gambar = htmlSpecialChars($data["gambar"]);

    // query insert data
    $query = "INSERT INTO mahasiswa 
    VALUES
    ('', '$nama','$nim','$email','$jurusan','$gambar')";
    mysqli_query($conn_db, $query);

    // mengembalikan jika data berhasil masuk ke db akan menghasilkan 1, jika tidak -1
    return mysqli_affected_rows($conn_db);
}
// fungsi untuk menghapus data
function hapus($id){
    
        global $conn_db;

        mysqli_query($conn_db, "DELETE FROM mahasiswa WHERE id = $id");
        return mysqli_affected_rows($conn_db);
}
// fungsi untuk merubah data
function ubah($data){
    global $conn_db;

    // data yang diubah dimasukan ke dalam variabel dan difilter dengan method

    // memasukan id yang ditangkap melalui file ubah
    $id = $data["id"];
    $nama = htmlSpecialChars($data["nama"]);
    $nim = htmlSpecialChars($data["nim"]);
    $email = htmlSpecialChars($data["email"]);
    $jurusan = htmlSpecialChars($data["jurusan"]);
    $gambar = htmlSpecialChars($data["gambar"]);

    // query insert data
    $query = "UPDATE mahasiswa SET 
                nama = '$nama',
                nim = '$nim',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = $id
                ";

    mysqli_query($conn_db, $query);

    // mengembalikan jika data berhasil masuk ke db akan menghasilkan 1, jika tidak -1
    return mysqli_affected_rows($conn_db);
}
?>