<?php

session_start();
require '../../config/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE email = '$email' ")[0];

$jumlahDataPerHalaman = 5;

// config pagination1

$totalData1 = count(query("SELECT `user_transaksi`.*, `user_market`.`market_name`, `item_market`.`item_name`, `item_market`.`item_type`, `item_market`.`item_image`
FROM `user_market` join `item_market` ON `user_market`.`id_market` = `item_market`.`id_market`
join `user_transaksi` ON `item_market`.`id_item` = `user_transaksi`.`id_item` 
WHERE `user_transaksi`.`email` = '$email' AND `user_transaksi`.`status_transaksi` = 'pending' OR `user_transaksi`.`status_transaksi` = 'dikirim' OR `user_transaksi`.`status_transaksi` = 'diterima'"));

$jumlahHalaman1 = ceil($totalData1 / $jumlahDataPerHalaman);
$halamanAktif1 = (isset($_GET["halamanPembelian"])) ? $_GET["halamanPembelian"] : 1;
$awalData1 = ($jumlahDataPerHalaman * $halamanAktif1) - $jumlahDataPerHalaman;

$transaksis = "SELECT `user_transaksi`.*, `user_market`.`market_name`, `item_market`.`item_name`, `item_market`.`item_type`, `item_market`.`item_image`
FROM `user_market` join `item_market` ON `user_market`.`id_market` = `item_market`.`id_market`
join `user_transaksi` ON `item_market`.`id_item` = `user_transaksi`.`id_item` 
WHERE `user_transaksi`.`email` = '$email' AND `user_transaksi`.`status_transaksi` = 'pending' OR `user_transaksi`.`status_transaksi` = 'dikirim' OR `user_transaksi`.`status_transaksi` = 'diterima' LIMIT $awalData1, $jumlahDataPerHalaman";

$query = mysqli_query($conn, $transaksis);

// config pagination2

$totalData2 = count(query("SELECT `user_transaksi`.*, `user_market`.`market_name`, `item_market`.`item_name`, `item_market`.`item_type`, `item_market`.`item_image` FROM `user_market` join `item_market` ON `user_market`.`id_market` = `item_market`.`id_market` join `user_transaksi` ON `item_market`.`id_item` = `user_transaksi`.`id_item` WHERE `user_transaksi`.`email` = '$email' AND `user_transaksi`.`status_transaksi` = 'sukses'"));

$jumlahHalaman2 = ceil($totalData2 / $jumlahDataPerHalaman);
$halamanAktif2 = (isset($_GET["halamanSukses"])) ? $_GET["halamanSukses"] : 1;
$awalData2 = ($jumlahDataPerHalaman * $halamanAktif2) - $jumlahDataPerHalaman;

$batals = "SELECT `user_transaksi`.*, `user_market`.`market_name`, `item_market`.`item_name`, `item_market`.`item_type`, `item_market`.`item_image`
FROM `user_market` join `item_market` ON `user_market`.`id_market` = `item_market`.`id_market`
join `user_transaksi` ON `item_market`.`id_item` = `user_transaksi`.`id_item` 
WHERE `user_transaksi`.`email` = '$email' AND `user_transaksi`.`status_transaksi` = 'sukses' LIMIT $awalData2, $jumlahDataPerHalaman";

$querys = mysqli_query($conn, $batals);

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

    <title>Chariot - Riwayat Pesanan</title>
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
                                <img class="img-profile rounded-circle" width="20px" src="../../../public_html/img/profile/<?= $user['image']; ?>">
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
                                    <img src="../../../public_html/img/material/logo.png" alt="">
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

    <div class="profile">

        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4">
                    <h2 class="mt-4">Riwayat Pesanan</h2>
                </div>
            </div>
            <!-- Menu -->
            <div class="row">
                <div class="col-2">
                    <section class="kanan">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active mb-2" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Pesanan saya</a>
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
                                        <a class="nav-link antri-pesan" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Pembelian</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active batal-pesan" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Sukses</a>
                                    </li>
                                </ul>
                                <!-- Akhir Menu Atas -->

                                <!-- Isi Menu Atas -->
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="table-min">
                                            <?php if (isset($_SESSION["accpt"])) : ?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="alert alert-success" role="alert">
                                                            Barang berhasil diterima</div>
                                                    </div>
                                                </div>
                                                <?php unset($_SESSION["accpt"]); ?>
                                            <?php endif; ?>
                                            <?php while ($transaksi = mysqli_fetch_assoc($query)) : ?>
                                                <div class="row mb-3">
                                                    <div class="col-lg-2">
                                                        <a href="user-item-detail.php?id_item=<?= $transaksi['id_item']; ?>"><img src="../../../public_html/img/item/<?= $transaksi['item_image']; ?>" alt="..." class="img-thumbnail item-para"></a>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <h3 class="font-weight-bold"><?= $transaksi['item_name']; ?> </h3>
                                                        <p><?= $transaksi['item_type']; ?> <span> | <?= $transaksi['many_transaksi']; ?> item</span></p>
                                                        <small><?= $transaksi['market_name']; ?> </small>
                                                        <p class="harga-para mt-3">Total Harga : Rp. <span class="harga-barang"><?= $transaksi['price_transaksi']; ?></span></p>
                                                    </div>
                                                    <div class="col-lg-3 tngl-pesan">
                                                        <p>Tanggal : </p>
                                                        <p><?= $transaksi['date_transaksi']; ?> </p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>Keterangan tambahan :</p>
                                                        <textarea name="" id="" cols="30" rows="1" readonly><?= $transaksi['info_transaksi']; ?> </textarea>
                                                        <?php if ($transaksi['payment_transaksi'] == 'pending') : ?>
                                                            <p>Status pembayaran <span style="color:red;">pending</span></p>
                                                        <?php else : ?>
                                                            <p>Status pembayaran <span style="color:green;">sukses</span></p>
                                                        <?php endif; ?>

                                                        <?php if ($transaksi['item_transaksi'] == 'pending') : ?>
                                                            <p>status barang <span style="color:red">pending</span></p>
                                                        <?php elseif ($transaksi['item_transaksi'] == 'dikirim') : ?>
                                                            <p>status barang <a href="user-market-buyer-accept.php?id_transaksi=<?= $transaksi['id_transaksi']; ?>" style="color:blue"><?= $transaksi['item_transaksi'];  ?></a></p>
                                                        <?php else : ?>
                                                            <p>status barang <span style="color:green">diterima</span></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>

                                        <div class="pagination">
                                            <?php if ($halamanAktif1 > 1) : ?>
                                                <ul>
                                                    <li>
                                                        <a href="user-history-delivery.php?halamanPembelian=<?= $halamanAktif1 - 1 ?>">&laquo;</a>
                                                    </li>
                                                </ul>
                                            <?php endif; ?>

                                            <?php for ($i = 1; $i <= $jumlahHalaman1; $i++) : ?>
                                                <?php if ($i == $halamanAktif1) : ?>
                                                    <li>
                                                        <a href="user-history-delivery.php?halamanPembelian=<?= $i ?>" class="active"><?= $i ?></a>
                                                    </li>
                                                <?php else : ?>
                                                    <li>
                                                        <a href="user-history-delivery.php?halamanPembelian=<?= $i ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endfor; ?>

                                            <?php if ($halamanAktif1 < $jumlahHalaman1) : ?>
                                                <ul>
                                                    <li>
                                                        <a href="user-history-delivery.php?halamanPembelian=<?= $halamanAktif1 + 1 ?>">&raquo;</a>
                                                    </li>
                                                </ul>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                                        <div class="table-min">
                                            <?php while ($batal = mysqli_fetch_assoc($querys)) : ?>
                                                <div class="row mb-3">
                                                    <div class="col-lg-2">
                                                        <a href="rinci-barang.html"><img src="../../../public_html/img/item/<?= $batal['item_image']; ?>" alt="..." class="img-thumbnail item-para"></a>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <h3 class="font-weight-bold"><?= $batal['item_name']; ?></h3>
                                                        <p><?= $batal['item_type']; ?><span> | <?= $batal['many_transaksi']; ?> item</span></p>
                                                        <p class="harga-para mt-4">Harga : Rp. <span class="harga-barang"><?= $batal['price_transaksi']; ?></span></p>
                                                    </div>
                                                    <div class="col-lg-3 tngl-pesan">
                                                        <p>Tanggal : </p>
                                                        <p><?= $batal['date_transaksi']; ?> </p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>Keterangan tambahan</p>
                                                        <textarea name="" id="" cols="30" rows="2" readonly><?= $batal['info_transaksi']; ?></textarea>
                                                        <p>status barang <span style="color:green;"><?= $batal['status_transaksi']; ?></span></p>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>

                                        <div class="pagination">
                                            <?php if ($halamanAktif2 > 1) : ?>
                                                <ul>
                                                    <li>
                                                        <a href="?halamanSukses=<?= $halamanAktif2 - 1 ?>">&laquo;</a>
                                                    </li>
                                                </ul>
                                            <?php endif; ?>

                                            <?php for ($i = 1; $i <= $jumlahHalaman2; $i++) : ?>
                                                <?php if ($i == $halamanAktif2) : ?>
                                                    <li>
                                                        <a href="?halamanSukses=<?= $i ?>" class="active"><?= $i ?></a>
                                                    </li>
                                                <?php else : ?>
                                                    <li>
                                                        <a href="?halamanSukses=<?= $i ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endfor; ?>

                                            <?php if ($halamanAktif2 < $jumlahHalaman2) : ?>
                                                <ul>
                                                    <li>
                                                        <a href="?halamanSukses=<?= $halamanAktif2 + 1 ?>">&raquo;</a>
                                                    </li>
                                                </ul>
                                            <?php endif; ?>
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
                    <a href="#"><img src="../../../public_html/img/material/logo.png" alt=""></a>
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