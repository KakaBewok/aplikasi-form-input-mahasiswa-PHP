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

    // $gambar = htmlSpecialChars($data["gambar"]);
 
    // upload gambar ke direktori
    $gambar = upload();
    
    // memeriksa apakah fungsi upload gagal(false), jika gagal akan stop. Jika berhasil akan menjalankan query tambah data atau nama file gambar disimpan ke db
    if(!$gambar){
        return false;
    }

    // query insert data
    $query = "INSERT INTO mahasiswa 
    VALUES
    ('', '$nama','$nim','$email','$jurusan','$gambar')";
    
    mysqli_query($conn_db, $query);

    // mengembalikan jika data berhasil masuk ke db akan menghasilkan 1, jika tidak -1
    return mysqli_affected_rows($conn_db);
}
// fungsi untuk mengupload gambar fungsi ini digunakan juga pada fungsi ubah
function upload(){
    // mengambil data-data pada gambar yang diupload melalui $_FILES
    // gambar.name = nama file + ekstensinya
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // melakukan pengecekan apakah tidak ada gambar yang diupload
    // kalo 4 berarti tidak ada gambar yang diupload
    if($error === 4){
        echo "<script>
                alert('Pilih gambar terlebih dahulu.');
                </script>";
    
    // ini untuk mengembalikan false pada fungsi upload()
    return false;
    }

    // jika ada gambar yang diupload, maka cek ekstensinya
    // cek lagi yang diupload gambar atau bukan(cek ekstensinya)
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    // explode adalah fungsi untuk memecah string menjadi array, memecahnya menggunakan delimiter
    $ekstensiGambar = explode('.', $namaFile); //string akan dipisahkan melalui titik(.) dari stringnya, kalo rizal.jpg, berarti akan jadi ['rizal', 'jpg']
    
    // method end berguna untuk mengambil array paling terakhir, artinya variabel dibawah akan mengambil ekstensinya saja (.jpg).
    // method strtolower berguna untuk merubah string menjadi huruf kecil semua
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // memeriksa apakah ekstensinya sudah sesuai dengan variabel ekstensi valid
    // method in_array akan memeriksa adakah sebuah string di dalam array(fungsi ini menghasilkan boolean)
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
                alert('Form hanya bisa menerima file gambar, silahkan upload kembali.');
                </script>";
    
    //return false artinya kode dibawahnya tidak akan dibaca
    return false;
    }

    // memeriksa apakah ukuran gambar sesuai atau terlalu besar
    // 1000000 = 1mb
    if($ukuranFile > 1000000){
        echo "<script>
                alert('Ukuran gambar anda melebihi 1MB.');
                </script>";
    
    return false;
    }

    // jika lolos pengecekan 1.upload kosong 2.gambar beda ekstensi 3.ukuran terlalu besar
    //gambar akan diupload, fungsi move_uploaded_files() berfungsi memindahkan gambar dari direktori sementara ke direktori tujuan

    // untuk menghindari namafile sama, maka nama gambar baru harus digenerate agar unik
    // method uniqid() akan menghasilkan angka random
    $namaFileBaru = uniqid();
    // operator .= penggunaannya mirip dengan += (untuk merangkai)
    $namaFileBaru .= '.'; //$namaFileBaru = $namaFileBaru . '.';
    $namaFileBaru .= $ekstensiGambar; ////$namaFileBaru = $namaFileBaru . ekstensiGambar;
    //fungsi move_uploaded_files() berfungsi memindahkan gambar dari direktori sementara ke direktori tujuan
    move_uploaded_file($tmpName, 'img/'. $namaFileBaru);

    // mengembalikan namafile, namafile akan digunakan untuk diupload ke dalam database
    return $namaFileBaru;
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
    // gambar lama sebelum diupdate
    $gambarLama = htmlSpecialChars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak, files['gambar'] diambil dari form input ubah gambar di file ubah.php
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // query insert data
    $query = "UPDATE mahasiswa SET 
                nama = '$nama',
                nim = '$nim',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = $id
                ";
    //variabel $gambar didapat dari hasil fungsi upload() yang mana itu adalah nama gambar baru hasil perubahan

    mysqli_query($conn_db, $query);

    // mengembalikan jika data berhasil masuk ke db akan menghasilkan 1, jika tidak -1
    return mysqli_affected_rows($conn_db);
}
// fungsi untuk mencari
function cari($keyword){
    // text query = artinya sama persis, kalo LIKE dan ditambah % pada akhir dan awal keywordnya yang mirip2 yang akan ditampilkan
    // OR artinya atau
    $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR 
                nim LIKE '%$keyword%' OR
                nama LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
                ";

    // fungsi query diambil dari fungsi diatas yang pertama dibuat
    return query($query);
}
// fungsi registrasi
function registrasi($data){
    global $conn_db;

    // 1. inisialisasi data $_POST ke variabel

    //stripslashes() berfungsi untuk membersihkan karakter slash
    //strtolower() untuk membuat username berhuruf kecil semua
    $username = strtolower(stripslashes($data['username']));
    //mysqli_real_escape_string() berfungsi untuk memungkinkan db menyimpan kutip di password
    $password = mysqli_real_escape_string($conn_db, $data['password']);
    $password2 = mysqli_real_escape_string($conn_db, $data['password2']);


    // 2. cek username sudah ada atau belum
    //ambil data dari tabel user yang usernamenya sama dengan username yg baru diinput
    $result = mysqli_query($conn_db, "SELECT username FROM users WHERE username = '$username'");
    //data result dipecah dan dicek, jika ada menghasilkan true, jika salah menghasilkan false
    if( mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username sudah terdaftar');
              </script>";
        return false;
    }

    // 3. cek konfirmasi password
    if($password !== $password2){
        echo "<script>
                alert('Konfirmasi password tidak sama');
              </script>";
        return false;
    } 

    // 4. enkripsi password, password_hash() untuk mengacak password,
    //parameternya password yang akan diacak dan algoritmanya
    $password = password_hash($password, PASSWORD_DEFAULT);

    // 5. masukan user baru ke db
    mysqli_query($conn_db, "INSERT INTO users VALUES(
        '',
        '$username',
        '$password'
    )");

    // 6. return efek query (berhasil = 1, gagal = 0)
    return mysqli_affected_rows($conn_db);
}

?>

