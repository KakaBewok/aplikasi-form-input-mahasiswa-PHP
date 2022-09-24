<?php
    require('./functions.php');
    
    if(isset($_POST['register'])){
        if(registrasi($_POST) > 0){
            echo "<script>
                    alert('User berhasil ditambahkan.');
                    document.location.href = 'registrasi.php';
                  </script>";
        } else {
            echo mysqli_error($conn_db);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css" />
    <title>REGISTRASI</title>
</head>
<body>
    <div class="container mt-5 mb-5" style="width: 40%">
        <h3>Registrasi</h3>
        <form action="" method="post" class="mt-3">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <!-- <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div> -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password2" name="password2">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="cek">
                <label class="form-check-label" for="cek">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary" name="register">Daftar</button>
        </form>
    </div>
<script src="./bootstrap/js/bootstrap.js"></script>
</body>
</html>