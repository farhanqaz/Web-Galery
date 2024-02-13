<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri | frhn</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header  -->
    <?php include_once 'src/header.php' ?>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>

    <!-- category -->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php
                require_once 'koneksi.php';
                $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                if (mysqli_num_rows($kategori) > 0) {
                    while ($i = mysqli_fetch_array($kategori)) {
                ?>
                        <a href="galeri.php?kat=<?php echo $i['category_id'] ?>">
                            <div class="col-5">
                                <img src="src/<?= $i['category_name'] ?>.png" width="50px" style="margin-bottom:5px;" />
                                <p><?php echo $i['category_name'] ?></p>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="container">
        <h3>Foto Terbaru</h3>
        <div class="box">
            <?php
            $foto = mysqli_query($conn, "SELECT * FROM image WHERE image_status = 1 ORDER BY image_id DESC LIMIT 8");
            if (mysqli_num_rows($foto) > 0) {
                while ($p = mysqli_fetch_array($foto)) {
            ?>
                    <a href="detail-image.php?id=<?php echo $p['image_id'] ?>">
                        <div class="col-4">
                            <img src="foto/<?php echo $p['image'] ?>" height="150px" />
                            <p class="nama"><?php echo substr($p['image_name'], 0, 30)  ?></p>
                            <p class="admin">Nama User : <?php echo $p['admin_name'] ?></p>
                            <p class="nama"><?php echo $p['date_created']  ?></p>
                        </div>
                    </a>
                <?php }
            } else { ?>
                <p>Foto tidak ada</p>
            <?php } ?>
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