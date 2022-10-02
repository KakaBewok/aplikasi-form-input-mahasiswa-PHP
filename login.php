<?php
    //setiap menggunakan session, pastikan selalu menggunakan method ini di paling atas program
    session_start();

    //untuk memeriksa, kalo sudah login tidak bisa lagi masuk ke laman login
    //memeriksa apakah $_SESSION['login'] sudah ada/true
    if(isset($_SESSION['login'])){
        header("Location: index.php");
        //untuk menghentikan eksekusi kode dibawahnya
        exit;
    }

    require('./functions.php');
    
    if(isset($_POST['masuk'])){
        // 1. ambil nilai kredensial
        $username = $_POST['username'];
        $password = $_POST['password'];

        //2. cek username udah ada atau belom
        $result = mysqli_query($conn_db, "SELECT * FROM users WHERE username = '$username'");
        //mysqli_num_rows() u/ menghitung berapa baris yang dikembalikan oleh $result dan mengembalikan boolean
        if(mysqli_num_rows($result) === 1){
            //3. jika usernamenya ada, cek passwordnya
            $row = mysqli_fetch_assoc($result);
            // password_verify() kebalikan method password_hash, ngecek hash sama gak dengan stringnya. Param 1 password dr user saat login, param 2 password dari db

            //4. jika password sama, arahkan ke index.php
            if(password_verify($password, $row['password'])){
                //set session
                //session akan tersimpan ke variabel super global session di dalam server
                //dan setiap pindah halaman, variabel session ini akan dicek dulu sebelum masuk
                $_SESSION['login'] = true;

                header("Location: index.php");
                exit;
            }
        }

        //5. tampilkan pesan error di form jika username dan password tidak ada/tidak match
        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css" />
    <title>MASUK</title>
</head>
<body>
    <div class="container mt-5 mb-5" style="width: 40%">
        <h3>MASUK</h3>
        
        <!-- cek ada error atau tidak, kalo error tampilkan pesan -->
        <?php if(isset($error)) :?>
            <br>
            <p class="badge bg-danger text-wrap text-uppercase fs-6">Username/password salah!</p>
        <?php endif; ?>

        <form action="" method="post" class="mt-3">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="cek">
                <label class="form-check-label" for="cek">Check me out</label>
            </div>
            <button type="submit" class="btn btn-success" name="masuk">Masuk</button>
        </form>
    </div>
<script src="./bootstrap/js/bootstrap.js"></script>
</body>
</html>