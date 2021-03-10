<?php

session_start();
require '../../config/functions.php';

$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE email = '$email' ")[0];

$jumlahDataPerHalaman = 5;

$totalData = count(query("SELECT `user_transaksi`.*, `user_market`.`market_name`, `item_market`.`item_name`, `item_market`.`item_type`, `item_market`.`item_image`, `user`.`name`, `user`.`image`, `user`.`address` FROM `user_market` join `item_market` ON `user_market`.`id_market` = `item_market`.`id_market` join `user_transaksi` ON `item_market`.`id_item` = `user_transaksi`.`id_item` JOIN `user` ON `user`.`email` = `user_transaksi`.`email`"));

$jumlahHalaman = ceil($totalData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halamanKeuangan"])) ? $_GET["halamanKeuangan"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$pembelis = query("SELECT `user_transaksi`.*, `user_market`.`market_name`, `item_market`.`item_name`, `item_market`.`item_type`, `item_market`.`item_image`, `user`.`name`, `user`.`image`, `user`.`address` FROM `user_market` join `item_market` ON `user_market`.`id_market` = `item_market`.`id_market` join `user_transaksi` ON `item_market`.`id_item` = `user_transaksi`.`id_item` JOIN `user` ON `user`.`email` = `user_transaksi`.`email` LIMIT $awalData, $jumlahDataPerHalaman");

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

    <title>Chariot - Menej Barang</title>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?> </span>
                                <img class="img-profile rounded-circle" width="20px" src="../../../public_html/images/profile/<?= $user['image']; ?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="admin-manage-user.php">
                                    <i class="fas fa-tasks fa-sm fa-fw mr-2 text-gray-400"></i>
                                    User
                                </a>
                                <a class="dropdown-item" href="admin-manage-item.php">
                                    <i class="fas fa-comments-dollar fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keuangan
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../user/user-logout.php">
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
                                    <button onClick="alert('Masih dalam proses Kelompok')"><i class="fab fa-searchengin"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <!-- menu -->
                        <ul class="main-menu">
                            <li><a href="admin-index.php">Beranda</a></li>
                            <li><a href="admin-index.php?kategori=Adidas">Adidas</a></li>
                            <li><a href="admin-index.php?kategori=New Balance">New Balance</a></li>
                            <li><a href="admin-index.php?kategori=Nike">Nike</a></li>
                            <li><a href="admin-index.php?kategori=Converse">Converse</a></li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
    </header>
    <!-- Akhir Navbar -->

    <div class="profile">

        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4">
                    <h2 class="mt-4">Data Keuangan</h2>
                </div>
            </div>
            <!-- Menu -->
            <div class="row">
                <div class="col-2">
                    <section class="kanan">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active mb-2" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Keuangan</a>
                        </div>
                    </section>
                </div>
                <div class="col-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <!-- Pesanan Saya -->
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="col-12">
                                <!-- Menu Atas -->
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active profile-akun-keu" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Data Keuangan
                                        </a>
                                    </li>
                                </ul>
                                <!-- Akhir Menu Atas -->

                                <!-- Isi Menu Atas -->
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <?php if (isset($_SESSION["acptItem"])) : ?>
                                            <div class="row">
                                                <div class="col-lg-12 mt-4">
                                                    <div class="alert alert-danger" role="alert">
                                                        Barang belum diterima oleh pembeli</div>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION["acptItem"]); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION["kirtItem"])) : ?>
                                            <div class="row">
                                                <div class="col-lg-12 mt-4">
                                                    <div class="alert alert-danger" role="alert">
                                                        Barang belum diterima oleh pembeli</div>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION["kirtItem"]); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION["sucItem"])) : ?>
                                            <div class="row">
                                                <div class="col-lg-12 mt-4">
                                                    <div class="alert alert-success" role="alert">
                                                        Uang sudah dikirim ke pejual!</div>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION["sucItem"]); ?>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="table-min">
                                                    <?php foreach ($pembelis as $pembeli) : ?>
                                                        <div class="row">
                                                            <div class="col-lg-2 mb-3">
                                                                <img src="../../../public_html/images/item/<?= $pembeli['item_image']; ?>" alt="..." class="img-thumbnail">
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <h3 class="font-weight-bold"><?= $pembeli['item_name']; ?> </h3>
                                                                <p><?= $pembeli['item_type']; ?> <span> | <?= $pembeli['many_transaksi']; ?> item</span></p>
                                                                <small>Pembeli <?= $pembeli['name']; ?> </small>

                                                                <?php if ($pembeli['bukti_transaksi'] != '-') : ?>
                                                                    <a href="admin-bukti-transaksi.php?id_transaksi=<?= $pembeli['id_transaksi']; ?>" class="fas fa-money-check-alt ml-2" style="color:blue;" target="_blank">
                                                                    </a>
                                                                <?php else : ?>
                                                                    <span class="fas fa-money-check-alt ml-2" style="color:red;"></span>
                                                                <?php endif; ?>

                                                                <p class="harga-para mt-3">Total harga : Rp. <span class="harga-barang"><?= $pembeli['price_transaksi']; ?> </span></p>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <center>
                                                                    <p>Pembayaran</p>
                                                                    <?php if ($pembeli['payment_transaksi'] == 'pending') : ?>
                                                                        <a href="admin-payment.php?id_transaksi=<?= $pembeli['id_transaksi']; ?>"><img src="../../../public_html/images/material/cross.png" width="20px" alt=""></a>
                                                                    <?php else : ?>
                                                                        <a href=""><img src="../../../public_html/images/material/ceklist.png" width="20px" alt=""></a>
                                                                    <?php endif; ?>
                                                                </center>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <center>
                                                                    <p>Barang Dikirim</p>
                                                                    <?php if ($pembeli['item_transaksi'] == 'pending') : ?>
                                                                        <img src="../../../public_html/images/material/cross.png" width="20px" alt="">
                                                                    <?php elseif ($pembeli['item_transaksi'] == 'dikirim') : ?>
                                                                        <img src="../../../public_html/images/material/truck.png" width="22px" style="margin-top:4px;" alt="">
                                                                    <?php else : ?>
                                                                        <img src="../../../public_html/images/material/ceklist.png" width="22px" style="margin-top:4px;" alt="">
                                                                    <?php endif; ?>
                                                                </center>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <center>
                                                                    <p>Kirim uang ke toko</p>
                                                                    <?php if ($pembeli['status_transaksi'] == 'pending') : ?>
                                                                        <a href="admin-sendmon.php?id_transaksi=<?= $pembeli['id_transaksi']; ?>"><img src="../../../public_html/images/material/cross.png" width="22px" style="margin-top:4px;" alt=""></a>
                                                                    <?php else : ?>
                                                                        <img src="../../../public_html/images/material/ceklist.png" width="22px" style="margin-top:4px;" alt="">
                                                                    <?php endif; ?>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="pagination">
                                                    <?php if ($halamanAktif > 1) : ?>
                                                        <ul>
                                                            <li>
                                                                <a href="?halamanKeuangan=<?= $halamanAktif - 1 ?>">&laquo;</a>
                                                            </li>
                                                        </ul>
                                                    <?php endif; ?>

                                                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                        <?php if ($i == $halamanAktif) : ?>
                                                            <li>
                                                                <a href="?halamanKeuangan=<?= $i ?>" class="active"><?= $i ?></a>
                                                            </li>
                                                        <?php else : ?>
                                                            <li>
                                                                <a href="?halamanKeuangan=<?= $i ?>"><?= $i ?></a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>

                                                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                                        <ul>
                                                            <li>
                                                                <a href="?halamanKeuangan=<?= $halamanAktif + 1 ?>">&raquo;</a>
                                                            </li>
                                                        </ul>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Isi Menu Atas -->
                            </div>
                        </div>
                        <!-- Akhir Pesanan Saya -->
                    </div>
                </div>
            </div>
            <!-- Akhir Menu -->
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