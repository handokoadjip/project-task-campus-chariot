<?php

session_start();
require '../../config/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE email = '$email' ")[0];

// untuk chekout
$_SESSION['id_item'] = $_GET['id_item'];

$item = query("SELECT * FROM item_market WHERE id_item = '$_SESSION[id_item]'")[0];
$market = query("SELECT * FROM user_market WHERE id_market = '$item[id_market]'")[0];

$items = query("SELECT `user_market`.*, `item_market`.*
FROM `user_market` JOIN `item_market`
ON `user_market`.`id_market` = `item_market`.`id_market` LIMIT 0,4
");

// Untuk chekout
$_SESSION['id_market'] = $market['id_market'];
$_SESSION['item_stock'] = $item['item_stock'];

if (isset($_POST["order"])) {
    if (order($_POST)) {
        header("Location: user-payment.php");
        $_SESSION['many_transaksi'] = $_POST['many_transaksi'];
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

    <title>Chariot - Detil Barang</title>
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

    <!-- Detail Barang -->
    <div class="tambah-barang-toko">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-1 mr-3">
                    <img src="../../../public_html/images/item/<?= $item['item_image']; ?>" width="100px" alt="">
                    <img src="../../../public_html/images/item/<?= $item['item_image']; ?>" class="mt-3" width="100px" alt="">
                    <img src="../../../public_html/images/item/<?= $item['item_image']; ?>" class="mt-3" width="100px" alt="">
                </div>
                <div class="col-lg-4">
                    <img src="../../../public_html/images/item/<?= $item['item_image']; ?>" width="329px" alt="">
                </div>
                <div class="col-lg-3 mr-3">
                    <h3><?= $item['item_name']; ?> </h3>
                    <p class="mb-3"><?= $item['item_type']; ?> | Stock : <?= $item['item_stock']; ?> </p>
                    <a href="">Rp. <?= $item['item_price']; ?> </a>
                    <h5 class="mt-2">Deskripsi</h5>
                    <p><?= $item['item_description']; ?> </p>
                </div>
                <div class="col-lg-3 info-tmbh  justify-content-end">
                    <h5>Informasi Tambahan</h5>
                    <form action="" method="post">
                        <div class="form-group">
                            <textarea class="form-control mt-2" id="exampleFormControlTextarea1" rows="3" cols="1" name="info"></textarea>
                        </div>
                        <small>Berapa banyak : </small>
                        <input type="number" class="btn-number mb-3" value="1" min="1" max="<?= $item['item_stock']; ?>" name="many_transaksi" autocomplete="off">
                        <button type="submit" name="order">Pesan</button>
                        <br>
                        <a href="" onClick="alert('Masih dalam proses Kelompok')"><img src="../../../public_html/images/material/button-cart.png" width="19px" alt="">Tambah
                            ke
                            whislist</a>
                    </form>
                </div>
            </div>

            <div class="row mt-3 toko">
                <div class="col-lg-1">
                    <img src="../../../public_html/images/market/<?= $market['market_image']; ?>" alt="" width="100px" height="100px" class="rounded-circle">
                </div>
                <div class="col-lg-3 ml-4">
                    <h3><?= $market['market_name']; ?> </h3>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-12">
                    <h3>Produk Lainnya</h3>
                </div>
            </div>
            <div class="row mb-5">
                <?php foreach ($items as $i) : ?>
                    <div class="col-md-3">
                        <div class="item1">
                            <a href="user-item-detail.php?id_item=<?= $i['id_item']; ?>"><img src="../../../public_html/images/item/<?= $i['item_image']; ?>" class="box mt-4" alt="Another Image zoom-on-hover effect"></a>
                            <h5><?= $i['item_name']; ?> </h5>
                            <small><?= $i['market_name']; ?></small>
                            <hr>
                            <p><?= $i['item_type']; ?></p>
                            <a href="" onClick="alert('Masih dalam proses Kelompok')" class="harga">Rp. <?= $i['item_price']; ?> </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Akhir Detail Barang -->

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

    <!-- My Script -->
    <script src="../../../public_html/js/script.js"></script>
</body>

</html>