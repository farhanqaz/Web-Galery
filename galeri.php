<?php
error_reporting(0);
require_once 'koneksi.php';
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
    <?php include_once 'src/header.php' ?>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>

    <!-- new product -->
    <div class="section">
        <div class="container">
            <h3>Galeri Foto</h3>
            <div class="box">
                <?php
                if ($_GET['search'] != '' || $_GET['kat'] != '') {
                    $where = "AND image_name LIKE '%" . $_GET['search'] . "%' AND category_id LIKE '%" . $_GET['kat'] . "%' ";
                }
                $foto = mysqli_query($conn, "SELECT * FROM image WHERE image_status = 1 $where ORDER BY image_id DESC");
                if (mysqli_num_rows($foto) > 0) {
                    while ($p = mysqli_fetch_array($foto)) {
                ?>
                        <a href="detail-image.php?id=<?php echo $p['image_id'] ?>">
                            <div class="col-4">
                                <img src="foto/<?php echo $p['image'] ?>" height="150px" />
                                <p class="nama"><?php echo substr($p['image_name'], 0, 30) ?></p>
                                <!-- <p class="harga"><?php //echo $p['admin_name'] ?></p> -->
                                <p class="admin">Nama Pengupload : <?php echo $p['admin_name'] ?></p>
                                <p class="nama"><?php echo $p['date_created']  ?></p>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <p>Foto tidak ada</p>
                <?php } ?>
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