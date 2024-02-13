<?php
require_once 'koneksi.php';

if (isset($_POST['submit'])) {

    $nama = ucwords($_POST['nama']);
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $mail = !empty($_POST['email']) ? $_POST['email'] : null;
    $role = 'user';

    $insert = mysqli_query($conn, "INSERT INTO admin (full_name, username, password, email, role) VALUES (
                            '" . $nama . "',
                            '" . $username . "',
                            '" . $password . "',
                            '" . $mail . "',
                            '" . $role . "')
                            ");
    if ($insert) {
        echo '<script>alert("Registrasi berhasil")</script>';
        echo '<script>window.location="login.php"</script>';
    } else {
        echo 'gagal ' . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Galeri Web</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('./sample/3.jpg'); /* Ganti 'background-image.jpg' dengan lokasi dan nama file gambar latar belakang Anda */
            background-size: cover;
            background-position: center;
        }
        
        .login-container {
            background-color: rgba(255, 255, 255, 0.7); /* Memberi efek transparan pada kotak login */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3); /* Menambahkan efek bayangan */
            max-width: 400px;
            width: 100%;
        }
        
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
        }
        
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-button {
            text-align: center;
            margin-top: 10px;
        }

        .back-button button {
            background-color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button button:hover {
            background-color: #999;
        }
        
        @media only screen and (max-width: 600px) {
            .login-container {
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Daftar</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="nama" required placeholder="Masukkan Nama">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="user" required placeholder="Masukkan Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="pass" required placeholder="Masukkan Password">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Masukkan Email (Optional)">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
        <p style="text-align: center;">Sudah Punya akun? <a href="login.php" style="color: #007bff;">Login di sini</a></p>
        <div class="back-button">
            <button type="button" onclick="location='index.php'">Kembali</button>
        </div>
    </div>
</body>
</html>