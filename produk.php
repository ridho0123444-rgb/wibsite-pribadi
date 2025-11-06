<?php
require "koneksi.php";
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// get produk by nama produk/keyword
if (isset($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($conn, $_GET['keyword']);

    // 🔥 Perbaikan di sini:
    // Cari di nama produk ATAU nama kategori
    $queryProduk = mysqli_query($conn, "
        SELECT p.* 
        FROM produk p
        LEFT JOIN kategori k ON p.kategori_id = k.id
        WHERE p.nama LIKE '%$keyword%' 
        OR k.nama LIKE '%$keyword%'
    ");
}
// get produk by kategori
else if (isset($_GET['kategori'])) {
    $kategoriNama = $_GET['kategori'];
    $queryGetKategoriId = mysqli_query($conn, "SELECT id FROM kategori WHERE nama='$kategoriNama'");
    $KategoriId = mysqli_fetch_array($queryGetKategoriId);
    $idKategori = $KategoriId['id'] ?? 0;
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$idKategori'");
}
// get produk default
else {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.4">
    <title>Toko Online | Produk</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body { margin: 0; padding: 0; }
        .navbar { margin-bottom: 0 !important; }
        .banner-produk {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('uploads/gambar1.png');
            background-size: cover;
            height: 400px;
            margin-top: 0;
            background-position: center;
        }
    </style>
</head>
<body>
    <?php require "navbar1.php"; ?>

    <div class="container-fluid banner-produk">
        <div class="container text-center text-white h-100 d-flex flex-column justify-content-center align-items-center">
            <h1>Produk Unggulan Kami</h1>
            <p>Belanja mudah, cepat, dan terpercaya</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <!-- KATEGORI -->
            <div class="col-lg-3">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($queryKategori)) { ?>
                        <a href="produk.php?kategori=<?php echo $kategori['nama']; ?>" style="text-decoration:none;">
                            <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                        </a>
                    <?php } ?>
                </ul>
            </div>

            <!-- PRODUK -->
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php 
                    if (mysqli_num_rows($queryProduk) == 0) {
                        echo "<p class='text-center'>Tidak ada produk ditemukan.</p>";
                    } else {
                        while($produk = mysqli_fetch_array($queryProduk)) { ?>
                            <div class="col-lg-3 mb-4">
                                <div class="card h-100">
                                    <img src="uploads/<?php echo $produk['foto']; ?>" class="card-img-top" alt="<?php echo $produk['nama']; ?>">
                                    <div class="card-body">
                                        <h4 class="card-title text-truncate"><?php echo $produk['nama']; ?></h4>
                                        <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                                        <p class="card-text fw-bold">Rp.<?php echo number_format($produk['harga'],0,',','.'); ?></p>
                                        <a href="produk-detail.php?nama=<?php echo $produk['nama']; ?>" class="btn btn-primary">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>

     <?php require "footer.php"; ?>

    <script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
