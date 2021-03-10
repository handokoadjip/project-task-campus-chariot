<?php

session_start();
require '../../config/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE email = '$email' ")[0];

$data['kategoris'] = ['Pilih Kategori', 'Adidas', 'New Balance', 'Nike', 'Converse'];

if (isset($_POST['addItem'])) {
    $error = [];

    if (empty($_POST['item_name'])) {
        $error['item_name'] = 'Nama barang tidak boleh kosong';
    }

    if (empty($_POST['item_type'])) {
        $error['item_type'] = 'Type barang tidak boleh kosong';
    }

    if (empty($_POST['item_price'])) {
        $error['item_price'] = 'Harga barang tidak boleh kosong';
    }

    if (empty($_POST['item_stock'])) {
        $error['item_stock'] = 'Stock barang tidak boleh kosong';
    }

    if (empty($_POST['item_des'])) {
        $error['item_des'] = 'Deskripsi tidak boleh kosong';
    }
}

if (isset($_POST["addItem"]) && !empty($_POST['item_name']) && !empty($_POST['item_type']) && !empty($_POST['item_price']) && !empty($_POST['item_stock']) && !empty($_POST['item_des'])) {
    if (addItem($_POST) > 0) {
        header("Location: user-market.php");
        $_SESSION["item"] = true;
    } else {
        echo mysqli_error($conn);
        die;
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="../../../public_html/vendors/bootstrap-4.3.1-dist/css/bootstrap.css">

    <!-- Font Awesome CSS -->
    <link type="text/css" rel="stylesheet" href="../../../public_html/fonts/fontawesome-free/css/all.css">

    <!-- Slicknav CSS -->
    <link type="text/css" rel="stylesheet" href="../../../public_html/vendors/slicknav/css/slicknav.min.css">

    <!-- Flickerplate CSS -->
    <link type="text/css" rel="stylesheet" href="../../../public_html/vendors/Flickerplate/css/flickerplate.css">
    <link type="text/css" rel="stylesheet" href="../../../public_html/vendors/Flickerplate/css/demo.css">
    <script src="../../../public_html/vendors/Flickerplate/js/hammer-v2.0.3.js"></script>
    <script src="../../../public_html/vendors/Flickerplate/js/flickerplate.js"></script>


    <!-- My CSS -->
    <link type="text/css" rel="stylesheet" href="../../../public_html/css/style.css">

    <title>Chariot - Tambah Barang</title>
</head>

<body>
    <!-- Navs -->
    <header class="header1">
        <div class="container-menu-header">
            <div class="topbar">
                <div class="topbar-social">
                    <p>Follow us : </p>
                    <a href="#" class="topbar-social-item fab fa-facebook-square ml-2"></a>
                    <a href="#" class="topbar-social-item fab fa-instagram"></a>
                    <a href="#" class="topbar-social-item fab fa-twitter"></a>
                </div>

                <div class="bgc">
                    <div class="topbar-child2">
                        <span class="toppbar-email">

                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ucfirst(explode(" ", $user['name'])[0]); ?> </span>
                                <img class="img-profile rounded-circle" width="20px" src="../../../public_html/images/profile/<?= $user['image']; ?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="user-profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Data diri
                                </a>
                                <a class="dropdown-item" href="user-history-delivery.php">
                                    <i class="fas fa-clipboard fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pesanan
                                </a>
                                <?php if (market() > 0) : ?>
                                    <a class="dropdown-item" href="user-market.php">
                                        <i class="fas fa-store fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Toko
                                    </a>
                                <?php else : ?>
                                    <a class="dropdown-item" href="user-market-created.php">
                                        <i class="fas fa-store fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Buat Toko
                                    </a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="user-password-change.php">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ganti Sandi
                                </a>
                                <a class="dropdown-item" href="user-logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="topbar-child1">
                    <span class="topbar-email ml-5">
                        <i class="far fa-question-circle"></i>
                    </span>
                    <span class="topbar-email ml-2 mr-5">
                        <a href="#" class="bantuan">Bantuan</a>
                    </span>
                </div>
            </div>
            <!-- Akhir Navs -->

            <!-- Navbar -->
            <header class="header-section">
                <div class="header-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 text-center text-lg-left">
                                <!-- logo -->
                                <a href="user-index.php" class="site-logo">
                                    <img src="../../../public_html/images/material/logo.png" alt="">
                                </a>
                            </div>
                            <div class="col-xl-6 col-lg-5">
                                <form class="header-search-form" action="user-item.php" method="get">
                                    <input type="text" name="cari" placeholder="Cari di Chariot ...." autocomplete="off">
                                    <button type="cari"><i class="fab fa-searchengin"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <!-- menu -->
                        <ul class="main-menu">
                            <li><a href="user-index.php">Beranda</a></li>
                            <li><a href="user-item.php?kategori=Adidas">Adidas</a></li>
                            <li><a href="user-item.php?kategori=New Balance">New Balance</a></li>
                            <li><a href="user-item.php?kategori=Nike">Nike</a></li>
                            <li><a href="user-item.php?kategori=Converse">Converse</a></li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
    </header>
    <!-- Akhir Navbar -->

    <div class="tambah-barang-toko">

        <div class="container">
            <?php if (isset($_SESSION["emptyImg"])) : ?>
                <div class="row ml-5" style="width:1205px;">
                    <div class="col-lg-10 ml-4">
                        <div class="alert alert-danger" role="alert">
                            Harus upload photo</div>
                    </div>
                </div>
                <?php unset($_SESSION["emptyImg"]); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION["fileEkstensi"])) : ?>
                <div class="row ml-5" style="width:1205px;">
                    <div class="col-lg-10 ml-4">
                        <div class="alert alert-danger" role="alert">
                            Yang diupload bukan gambar</div>
                    </div>
                </div>
                <?php unset($_SESSION["fileEkstensi"]); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION["fileSize"])) : ?>
                <div class="row ml-5" style="width:1205px;">
                    <div class="col-lg-10 ml-4">
                        <div class="alert alert-danger" role="alert">
                            File Terlalu Besar. Max 2MB</div>
                    </div>
                </div>
                <?php unset($_SESSION["fileSize"]); ?>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="row upload-file-toko">
                    <div class="col-lg-12 file-photo">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-5 box mr-3">
                                <label for="upload-photo">Tambahkan Photo</label>
                                <input type="file" class="form-control-file" id="upload-photo" name="item_image">
                            </div>
                            <div class="form-group col-md-5 box">
                                <div class="row">
                                    <div class="col-lg">
                                        <label for="nama-barang">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama-barang" name="item_name" autocomplete="off">
                                        <small class="text-danger pl-3"><?= isset($error['item_name']) ? $error['item_name'] : '';  ?></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label for="type-barang" class="mt-3">Type</label>
                                        <input type="text" class="form-control" id="type-barang" name="item_type" autocomplete="off">
                                        <small class="text-danger pl-3"><?= isset($error['item_type']) ? $error['item_type'] : '';  ?></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label for="harga-barang" class="mt-3">Harga Barang</label>
                                        <input type="text" class="form-control" id="harga-barang" name="item_price" autocomplete="off">
                                        <small class="text-danger pl-3"><?= isset($error['item_price']) ? $error['item_price'] : '';  ?></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <label for="stock-barang" class="mt-3">Stock Barang</label>
                                        <input type="text" class="form-control" id="stock-barang" name="item_stock" autocomplete="off">
                                        <small class="text-danger pl-3"><?= isset($error['item_stock']) ? $error['item_stock'] : '';  ?></small>
                                    </div>
                                </div>
                                <label for="kategori-barang" class="mt-3">Kategori</label>
                                <select class="form-control" id="kategori-barang" name="item_category">
                                    <?php foreach ($data["kategoris"] as $kategori) : ?>
                                        <option value="<?= $kategori; ?>"><?= $kategori; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="bg">
                                <div class="form-group col-md-12 box">
                                    <label for="detail-barang" class="mt-3">Detail Barang</label>
                                    <textarea name="item_des" class="form-control" id="detail-barang" class="mt-2" rows="3"></textarea>
                                    <small class="text-danger pl-3"><?= isset($error['item_des']) ? $error['item_des'] : '';  ?></small>
                                </div>
                            </div>
                            <div class="col-md-10 mt-3">
                                <button class="btn btn-warning float-right" name="addItem">Simpan</button>
                                <a href="user-market.php" class="btn btn-danger float-right mr-2">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <section class="footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <a href="#"><img src="../../../public_html/images/material/logo.png" alt=""></a>
                    <p class="text-justify mt-3">Sebagai Market Sepatu terbesar di Indonesia kami ingin memberikan
                        pengalaman
                        dan kemudahan dalam berbelanja produk original dengan brand - brand
                        internasional ternama serta kualitas terbaik. Kami juga ingin memberikan
                        kemudahan bagi para brand local di Indonesia untuk bersaing dan dapat diliat
                        oleh masyarakat local maupun internasional. <strong>Sehingga menjadikan Chariot
                            suatu kesempatan untuk mencapai goal Bersama.</strong></p>
                </div>
                <div class="col-lg-2 block-a rights col-md-6">
                    <h4 class="foot-sub">Layanan</h4>
                    <a class="mt-2" href="#">Konfirmasi Transfer</a>
                    <a href="#">Hubungi Kami</a>
                    <a href="#">Bantuan</a>
                    <a href="#">Status Order</a>
                    <a href="#">Pengembalian</a>
                    <a href="#">Cara Penjualan</a>
                </div>
                <div class="col-lg-3 block-a rights col-md-6">
                    <h4 class="foot-sub">Tentang Kami</h4>
                    <a class="mt-2" href="#">About Us</a>
                    <a href="#">Peomosi Brand</a>
                    <a href="#">Karir</a>
                    <a href="#">THREAD by Chariot</a>
                </div>
            </div>


            <div class="row justify-content-between mt-5">
                <div class="col-lg-5 col-md-6">
                    <p>Anda punya pertanyaan? kami siap membantu</p>
                    <a href="#" class="hov">Kontak</a> <strong class="mx-2">|</strong> <a href="#" class="hov">Customer
                        Information</a>
                </div>
                <div class="col-lg-6 rights col-md-6">
                    <a href="#">Tentang Chariot</a> <strong class="mx-2">|</strong> <a href="#">Kebijakan Privasi</a>
                    <strong class="mx-2">|</strong> <a href="#">Syarat
                        dan Ketentuan </a>
                    <p>2019,- 2020 Chariot</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../../public_html/vendors/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="../../../public_html/vendors/bootstrap-4.3.1-dist/js/bootstrap.js"></script>

    <!-- Vendor -->
    <script src="../../../public_html/vendors/slicknav/js/jquery.slicknav.min.js"></script>
    <script>
        new flickerplate('.flicker-example');
    </script>

    <script>
        new flickerplate('.flicker-example');

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>

    <!-- My Script -->
    <script src="../../../public_html/js/script.js"></script>
</body>

</html>