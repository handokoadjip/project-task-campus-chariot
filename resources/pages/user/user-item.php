<?php


session_start();
require '../../config/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE email = '$email' ")[0];

if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $select = "SELECT `user_market`.`market_name`, `item_market`.*
    FROM `user_market` JOIN `item_market`
    ON `user_market`.`id_market` = `item_market`.`id_market` WHERE `item_market`.`item_name` LIKE '%$cari%'
    AND `item_market`.`is_active` = 1";
} else if (isset($_GET['kategori'])) {
    $category = $_GET['kategori'];
    $select = "SELECT `user_market`.`market_name`, `item_market`.*
    FROM `user_market` JOIN `item_market`
    ON `user_market`.`id_market` = `item_market`.`id_market` WHERE `item_market`.`item_category` LIKE '$category' AND `item_market`.`is_active` = 1
    ";
} else {
    $select = "SELECT `user_market`.`market_name`, `item_market`.*
    FROM `user_market` JOIN `item_market`
    ON `user_market`.`id_market` = `item_market`.`id_market` WHERE `item_market`.`is_active` = 1
    ";
}

$query = mysqli_query($conn, $select);
$result = mysqli_num_rows($query);

if ($result == 0) {
    $_SESSION["noItem"] = true;;
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

    <title>Chariot - Barang</title>
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

    <div class="login-system">

        <div class="container">
            <section class="variant">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Varian Sepatu</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-interval="10000">
                                    <img src="../../../public_html/images/material/promo-1.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item" data-interval="2000">
                                    <img src="../../../public_html/images/material/promo-2.png" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 sidebar-filter mt-4">
                                <h2>Kategori</h2>
                                <h4>Merek</h4>
                                <ul>
                                    <li><a href="user-item.php"> Semua Barang</a></li>
                                    <li><a href="user-item.php?kategori=Adidas"> Addidas</a></li>
                                    <li><a href="user-item.php?kategori=New Balance"> New Balance</a></li>
                                    <li><a href="user-item.php?kategori=Nike"> Nike</a></li>
                                    <li><a href="user-item.php?kategori=Converse"> Converse</a></li>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <?php if (isset($_SESSION["noItem"])) : ?>
                                    <div class="row">
                                        <div class="col-lg-12 mt-4">
                                            <div class="alert alert-danger" role="alert">
                                                Barang tidak ditemukan</div>
                                        </div>
                                    </div>
                                    <?php unset($_SESSION["noItem"]); ?>
                                <?php endif; ?>
                                <div class="row">
                                    <?php while ($item = mysqli_fetch_assoc($query)) : ?>
                                        <div class="col-md-4">
                                            <div class="item1">
                                                <a href="user-item-detail.php?id_item=<?= $item['id_item']; ?>"><img src="../../../public_html/images/item/<?= $item['item_image']; ?>" class="box mt-4" alt="Another Image zoom-on-hover effect" width="371px" height="235px"></a>
                                                <h5 class="mt-2"><?= $item['item_name']; ?></h5>
                                                <small> <?= $item['item_type']; ?></small>
                                                <div class="row mt-1 justify-content-end">
                                                    <div class="col-lg-7">
                                                        <small><?= waktu_lalu($item['item_created']); ?></small>
                                                    </div>
                                                </div>
                                                <hr>
                                                <p>Toko <?= $item['market_name']; ?> </p>
                                                <a href="" class="harga mb-4">Rp. <?= number_format($item['item_price'], 0, '.', '.'); ?></a>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>

            </section>
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

    <!-- My Script -->
    <script src="../../../public_html/js/script.js"></script>
</body>

</html>