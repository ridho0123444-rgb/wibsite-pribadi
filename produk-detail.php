<?php
require "koneksi.php";

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukTerkait = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* ==== Gaya produk terkait ==== */
        .produk-terkait-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .produk-terkait-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .produk-terkait-item:hover img {
            transform: scale(1.05);
        }

        /* 🔵 Nama produk sekarang di atas gambar */
        .produk-terkait-nama {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 10px 0;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .produk-terkait-harga {
            text-align: center;
            color: #fff;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php require "navbar1.php"; ?>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="uploads/<?php echo $produk['foto']; ?>" class="w-100" alt="">
                </div>
                <div class="col-md-7">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p class="fs-5">
                        <?php echo $produk['detail']; ?>
                    </p>
                    <p class="fs-3">
                        Rp.<?php echo $produk['harga']; ?>
                    </p>
                    <p class="fs-5">Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok']; ?></strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- PRODUK TERKAIT -->
    <div class="container-fluid py-5 bg-secondary">
        <div class="container">
            <h2 class="text-center text-white">Produk Terkait</h2>

            <div class="row mt-5">
                <?php while($produkTerkait = mysqli_fetch_array($queryProdukTerkait)) { ?>
                <div class="col-lg-3 mb-4">
                    <a href="produk-detail.php?nama=<?php echo $produkTerkait['nama']; ?>" class="text-decoration-none">
                        <div class="produk-terkait-item">
                            <img src="uploads/<?php echo $produkTerkait['foto']; ?>" class="img-fluid" alt="">
                            <div class="produk-terkait-nama"><?php echo $produkTerkait['nama']; ?></div>
                        </div>
                        <p class="produk-terkait-harga">Rp.<?php echo number_format($produkTerkait['harga'],0,',','.'); ?></p>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require "footer.php"; ?>

    <script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
