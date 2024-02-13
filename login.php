<?php
		if (isset($_POST['submit'])) {
			session_start();
			require_once 'koneksi.php';

			$user = mysqli_real_escape_string($conn, $_POST['user']);
			$pass = mysqli_real_escape_string($conn, $_POST['pass']);

			$cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '" . $user . "'AND password = '" . $pass . "'");
			if (mysqli_num_rows($cek) > 0) {
				$d = mysqli_fetch_object($cek);
				$_SESSION['status_login'] = true;
				$_SESSION['a_global'] = $d;
				$_SESSION['id'] = $d->admin_id;
				echo "<script> alert('{ code: 200, user: $d->username, pesan: login berhasil! }'); window.location='dashboard.php';</script>";
			} else {
				echo "<script> alert('{ code: 403, pesan: username/password salah! }');</script>";
			}
		}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Galeri Web</title>
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
        <h2>Login</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="user" required placeholder="Masukkan Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="pass" required placeholder="Masukkan Password">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
        <p style="text-align: center;">Belum punya akun? <a href="registrasi.php" style="color: #007bff;">Daftar di sini</a></p>
        <div class="back-button">
            <button type="button" onclick="location='index.php'">Kembali</button>
        </div>
    </div>
</body>
</html>

