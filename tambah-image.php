<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Galeri | frhn</title>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Galeri | frhn</a></h1>
            <ul>
                <li><a href="galeri.php">Galeri</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-image.php">Data Foto</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Tambah Data Foto</h3>
            <div class="box">

                <form action="" method="POST" enctype="multipart/form-data">

                    <?php $result = mysqli_query($conn, "select * from category");
                    $jsArray = "var prdName = new Array();\n";
                    echo '<select class="input-control" name="kategori" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]" required>  <option>-Pilih Kategori Foto-</option>';
                    while ($row = mysqli_fetch_array($result)) {
                        echo ' <option value="' . $row['category_id'] . $row['category_name'] . '">' . $row['category_name'] . '</option>';
                        $jsArray .= "prdName['" . $row['category_id'] . "'] = '" . addslashes($row['category_name']) . "';\n";
                    }
                    echo '</select>'; ?>
                    </select>
                    <!-- <input hidden name="nama_kategori" id="prd_name" value=""> -->
                    <input readonly="readonly" class="input-control" name="admin_id" value="<?php echo $_SESSION['a_global']->admin_id ?>">
                    <input type="text" name="nama_admin" class="input-control" value="<?php echo $_SESSION['a_global']->full_name ?>" readonly="readonly">
                    <input type="text" name="nama" class="input-control" placeholder="Nama Foto" required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br />
                    <input type="file" name="gambar" class="input-control" required>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    // print_r($_FILES[gambar']);
                    // menampung inputan dari form
                    $kat       = preg_split('/(?<=\d)(?=[a-zA-Z])/', $_POST['kategori']);
                    $kategori  = $kat[0];
                    $nama_ka   = $kat[1];
                    $ida       = $_POST['admin_id'];
                    $user      = $_POST['nama_admin'];
                    $nama      = $_POST['nama'];
                    $deskripsi = $_POST['deskripsi'];
                    $status    = $_POST['status'];
                    var_dump($kat);

                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];

                    $newname = 'foto' . time() . '.' . $type2;

                    // menampung data format file yang diizinkan
                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                    // validasi format file
                    if (!in_array($type2, $tipe_diizinkan)) {
                        // jika format file tidak ada di dalam tipe diizinkan
                        echo '<script>alert("Format file tidak diizinkan")</script>';
                    } else {
                        // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                        // proses upload file sekaligus insert ke database
                        move_uploaded_file($tmp_name, './foto/' . $newname);

                        $insert = mysqli_query($conn, "INSERT INTO image (category_id, category_name, admin_id, admin_name, image_name, image_description, image, image_status) VALUES (
									   '" . $kategori . "',
									   '" . $nama_ka . "',
									   '" . $ida . "',
									   '" . $user . "',
									   '" . $nama . "',
									   '" . $deskripsi . "',
									   '" . $newname . "',
									   '" . $status . "')");

                        if ($insert) {
                            echo '<script>alert("{ code: 200, pesan: Tambah Gambar Berhasil! }")</script>';
                            echo '<script>window.location="data-image.php"</script>';
                        } else {
                            echo 'gagal' . mysqli_error($conn);
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Galeri | frhn.</small>
        </div>
    </footer>
    <!-- <script>
        CKEDITOR.replace('deskripsi');
    </script>
    <script type="text/javascript">
        <?php //echo $jsArray; ?>
    </script> -->
</body>

</html>