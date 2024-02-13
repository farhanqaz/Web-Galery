<?php
session_start();
require_once 'koneksi.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
$query = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id ='" . $_SESSION['id'] . "'");
$d = mysqli_fetch_object($query);

?>
<!DOCTYPE html >
<html >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri | frhn</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Galeri | frhn</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="data-image.php">Data Foto</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <label for="nama">Nama User</label>
                    <input id="nama" type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->full_name ?>" required>
                    <label for="username">Username</label>
                    <input id="username" type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->email ?>" required>
                    <label for="role">Role</label>
                    <input id="role" type="text" name="role" disabled class="input-control" value="<?php echo $d->role ?>" required>

                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    $nama   = $_POST['nama'];
                    $user   = $_POST['user'];
                    $email  = $_POST['email'];

                    $update = mysqli_query($conn, "UPDATE admin SET 
					                  full_name = '" . $nama . "',
									  username = '" . $user . "',
									  email = '" . $email . "',
									  WHERE admin_id = '" . $d->admin_id . "'");
                    if ($update) {
                        echo '<script>alert("{ code: 200, pesan: Ubah Data Berhasil! }")</script>';
                        echo '<script>window.location="profil.php"</script>';
                    } else {
                        echo 'gagal ' . mysqli_error($conn);
                    }
                }
                ?>
            </div>

            <h3>Ubah password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                <?php
                if (isset($_POST['ubah_password'])) {

                    $pass1   = $_POST['pass1'];
                    $pass2   = $_POST['pass2'];

                    if ($pass2 != $pass1) {
                        echo '<script>alert("{ code: 403, pesan: Konfirmasi Password Berbeda! }")</script>';
                    } else {
                        $u_pass = mysqli_query($conn, "UPDATE admin SET 
									  password = '" . $pass1 . "'
									  WHERE admin_id = '" . $d->admin_id . "'");
                        if ($u_pass) {
                            echo '<script>alert("{ code: 200, pesan: Ubah Password Berhasil! }")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        } else {
                            echo 'gagal ' . mysqli_error($conn);
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Galeri | frhn.</small>
        </div>
    </footer>
</body>

</html>