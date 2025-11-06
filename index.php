<?php
    require "koneksi.php";
    $queryProduk = mysqli_query($conn, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.4">
    <title>Toko Online | Home</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .card-img-top {
            border: 4px solid #b0b0b0;
            border-radius: 10px;
        }

        .btn-lihat {
            background-color: #a9a9a9;
            color: #fff;
            border: none;
            padding: 12px 28px;
            font-size: 18px;
            border-radius: 8px;
            margin-top: 40px;
            transition: 0.3s;
        }

        .btn-lihat:hover {
            background-color: #808080;
            color: #fff;
        }

        /* === Hanya bagian ini yang diubah === */
        .btn-detail {
            background-color: #007bff; /* biru */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 15px;
            transition: 0.3s;
        }

        .btn-detail:hover {
            background-color: #0056b3; /* biru lebih gelap saat hover */
            color: #fff;
        }
        /* ===================================== */
    </style>
</head>

<body>
    <?php require "navbar1.php"; ?>

    <div class="container-fluid banner">
        <div class="container text-center text-white h-100 d-flex flex-column justify-content-center align-items-center">
            <h1>Toko Online Kita</h1>
            <h3>Mau Cari Apa?</h3>
            <div class="col-10">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" name="keyword" class="form-control" placeholder="Nama Barang">
                        <button type="submit" class="btn btn-primary">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- KATEGORI TERLARIS -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>
            <div class="row mt-4">
                <div class="col-md-4">
                    <a href="produk.php?kategori=Bantal" class="text-decoration-none text-dark">
                        <div class="highlighted-kategori kategori-bantal"></div>
                        <h4 class="mt-2">Bantal</h4>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="produk.php?kategori=Tas" class="text-decoration-none text-dark">
                        <div class="highlighted-kategori kategori-tas"></div>
                        <h4 class="mt-2">Tas</h4>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="produk.php?kategori=Snack" class="text-decoration-none text-dark">
                        <div class="highlighted-kategori kategori-snack"></div>
                        <h4 class="mt-2">Snack</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- TENTANG KITA -->
    <div class="container-fluid py-5">
        <a href="tentang.php" class="text-decoration-none text-dark">
        <div class="container text-center">
            <div class="p-5" style="background-color: #e0e0e0; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                <h3 class="mb-3">Tentang Kita</h3>
                <p class="fs-5 mt-3">
                    Selamat datang di Toko Online, tempat belanja berbagai produk berkualitas dari pelaku UMKM lokal.
                    Kami menyediakan beragam kebutuhan seperti tas wanita elegan, baju batik khas Indonesia, snack lezat dari UMKM, bantal dekoratif yang nyaman, serta sajadah lembut untuk ibadah Anda.
                    <br><br>
                    Di Toko Online, kami berkomitmen untuk menghadirkan produk terbaik dengan harga terjangkau, sekaligus mendukung pertumbuhan usaha kecil di Indonesia.
                    Kami percaya bahwa setiap produk lokal memiliki nilai dan cerita yang unik — itulah mengapa kami bangga menjadi penghubung antara pelanggan dan para pengrajin lokal.
                </p>
                </a>
            </div>
        </div>
    </div>

    <!-- PRODUK -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>
            <div class="row mt-5">
                <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="uploads/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                            <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                            <p class="card-text">Rp.<?php echo number_format($data['harga'],0,',','.'); ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn-detail">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <button class="btn-lihat">Lihat Lebih Banyak</button>
        </div>
    </div>

    <?php require "footer.php"; ?>

    <script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
