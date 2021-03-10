<?php

session_start();
require '../../config/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

$jumlahDataPerHalaman = 5;

$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE email = '$email' ")[0];
$user_market = query("SELECT * FROM user_market WHERE email = '$email' ")[0];

$_SESSION["id_market"] = $user_market['id_market'];
$id_market = $user_market['id_market'];

// config Pagination

$totalData1 = count(query("SELECT * FROM item_market WHERE id_market = '$id_market'"));

$jumlahHalaman1 = ceil($totalData1 / $jumlahDataPerHalaman);
$halamanAktif1 = (isset($_GET["halamanBarang"])) ? $_GET["halamanBarang"] : 1;
$awalData1 = ($jumlahDataPerHalaman * $halamanAktif1) - $jumlahDataPerHalaman;

$items = query("SELECT * FROM item_market WHERE id_market = '$id_market' LIMIT $awalData1, $jumlahDataPerHalaman");

// config Pagination

$totalData2 = count(query("SELECT `user_transaksi`.*, `user_market`.`market_name`, `item_market`.`item_name`, `item_market`.`item_type`, `item_market`.`item_image`, `user`.`name`, `user`.`image`, `user`.`address` FROM `user_market` join `item_market` ON `user_market`.`id_market` = `item_market`.`id_market` join `user_transaksi` ON `item_market`.`id_item` = `user_transaksi`.`id_item` JOIN `user` ON `user`.`email` = `user_transaksi`.`email` WHERE `user_market`.`id_market` = '$id_market'"));

$jumlahHalaman2 = ceil($totalData2 / $jumlahDataPerHalaman);
$halamanAktif2 = (isset($_GET["halamanPembeli"])) ? $_GET["halamanPembeli"] : 1;
$awalData2 = ($jumlahDataPerHalaman * $halamanAktif2) - $jumlahDataPerHalaman;

$pembelis = query("SELECT `user_transaksi`.*, `user_market`.`market_name`, `item_market`.`item_name`, `item_market`.`item_type`, `item_market`.`item_image`, `user`.`name`, `user`.`image`, `user`.`address` FROM `user_market` join `item_market` ON `user_market`.`id_market` = `item_market`.`id_market` join `user_transaksi` ON `item_market`.`id_item` = `user_transaksi`.`id_item` JOIN `user` ON `user`.`email` = `user_transaksi`.`email` WHERE `user_market`.`id_market` = '$id_market' LIMIT $awalData2, $jumlahDataPerHalaman");

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

    <!-- Sweetalert -->
    <link type="text/css" rel="stylesheet" href="../../../public_html/vendors/sweetalert2-8.13.0/package/dist/sweetalert2.css">

    <!-- My CSS -->
    <link type="text/css" rel="stylesheet" href="../../../public_html/css/style.css">

    <title>Chariot - Toko</title>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ucfirst(explode(" ", $user['name'])[0]);  ?> </span>
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

    <div class="profile">

        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4">
                    <h2 class="mt-4">Profile Toko</h2>
                </div>
            </div>
            <!-- Menu -->
            <div class="row">
                <div class="col-2">
                    <section class="kanan">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active mb-2" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Toko
                                saya</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Barang</a>
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
                                        <a class="nav-link active profile-akun-ums" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Toko Anda
                                            <p>Kelola toko anda untuk mengontrol, melindungi, dan mengamankan toko anda
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Akhir Menu Atas -->

                                <!-- Isi Menu Atas -->
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <?php if (isset($_SESSION["market"])) : ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success" role="alert">
                                                        Toko berhasil dibuat</div>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION["market"]); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION["editMarket"])) : ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success" role="alert">
                                                        Toko berhasil diubah</div>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION["editMarket"]); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION["item"])) : ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success" role="alert">
                                                        Barang berhasil ditambahkan! lihat di barang</div>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION["item"]); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION["editItem"])) : ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success" role="alert">
                                                        Barang berhasil diubah! lihat di barang</div>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION["editItem"]); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION["deleteItem"])) : ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success" role="alert">
                                                        Barang berhasil dihapus! lihat di barang</div>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION["deleteItem"]); ?>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-lg-3 profiles">
                                                <p>Nama Toko</p>
                                                <p>Nama Pemilik</p>
                                                <p>Nomor Rekening</p>
                                                <p>Email</p>
                                                <p>Nomor Telp/HP</p>
                                                <p>Alamat</p>
                                                <p>Tanggal Dibuat</p>
                                            </div>

                                            <div class="col-lg-1 profiles">
                                                <p>:</p>
                                                <p>:</p>
                                                <p>:</p>
                                                <p>:</p>
                                                <p>:</p>
                                                <p>:</p>
                                            </div>

                                            <div class="col-lg-4 profiles">
                                                <p><?= $user_market['market_name']; ?> </p>
                                                <p><?= $user['name']; ?> </p>
                                                <p><?= $user_market['market_rek']; ?> </p>
                                                <p><?= $user['email'] ?></p>
                                                <p><?= $user['no_telp']; ?> </p>
                                                <p><?= $user_market['market_address']; ?> </p>
                                                <p><?= waktu_lalu($user_market['market_created']); ?> </p>
                                            </div>

                                            <div class="col-lg-4 images">
                                                <img src="../../../public_html/images/market/<?= $user_market['market_image']; ?>" alt="..." class="img-thumbnail">
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="user-market-edit.php" class="btn btn-warning font-weight-bold mt-5">Ubah
                                                        Toko</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Isi Menu Atas -->
                            </div>
                        </div>
                        <!-- Akhir Pesanan Saya -->

                        <!-- Toko Saya -->
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active barang-toko" id="pills-barang-tab" data-toggle="pill" href="#pills-barang" role="tab" aria-controls="pills-barang" aria-selected="true">Barang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link beli-toko" id="pills-pembeli-tab" data-toggle="pill" href="#pills-pembeli" role="tab" aria-controls="pills-pembeli" aria-selected="false">Pembeli</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-barang" role="tabpanel" aria-labelledby="pills-barang-tab">
                                    <div class="table-min">
                                        <?php foreach ($items as $item) : ?>
                                            <div class="row mb-3">
                                                <div class="col-lg-2">
                                                    <?php if ($item['is_active'] == 1) : ?>
                                                        <a href="user-item-detail.php?id_item=<?= $item['id_item']; ?>"><img src="../../../public_html/images/item/<?= $item['item_image']; ?>" alt="..." class="img-thumbnail item-para"></a>
                                                    <?php else : ?>
                                                        <img src="../../../public_html/images/item/<?= $item['item_image']; ?>" alt="..." class="img-thumbnail" style="opacity: .5;">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-lg-3">
                                                    <?php if ($item['is_active'] == 1) : ?>
                                                        <h3 class="font-weight-bold"><?= $item['item_name']; ?> </h3>
                                                        <p><?= $item['item_type']; ?> </p>
                                                        <p class="harga-para mt-4">Harga : Rp. <span class="harga-barang"><?= $item['item_price']; ?> </span></p>
                                                    <?php else : ?>
                                                        <h3 class="font-weight-bold" style="color:#bbb;"><?= $item['item_name']; ?> </h3>
                                                        <p style="color:#ccc;"><?= $item['item_type']; ?> </p>
                                                        <p class="harga-para mt-4" style="color:#ccc;">Harga : Rp. <span class="harga-barang"><?= $item['item_price']; ?> </span></p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-lg-3">
                                                    <?php if ($item['is_active'] == 1) : ?>
                                                        <p class="stock-para">Stock <span class="harga-barang"><?= $item['item_stock']; ?> </span></p>
                                                        <p>Di post <span class="harga-barang"><?= waktu_lalu($item['item_created']); ?> </span></p>
                                                    <?php else : ?>
                                                        <p class="stock-para" style="color:#ccc;">Stock <span class="harga-barang" style="color:#ccc;"><?= $item['item_stock']; ?> </span></p>
                                                        <p style="color:#ccc;">Di post <span class="harga-barang"><?= waktu_lalu($item['item_created']); ?> </span></p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-lg-3 aksi-para">
                                                    <?php if ($item['is_active'] == 1) : ?>
                                                        <a href="user-item-edit.php?user_item=<?= $item['id_item']; ?>" class="edit-para">Edit</a>
                                                        <a href="delete-item.php?user_item=<?= $item['id_item']; ?>" class="hapus-para">Hapus</a>
                                                    <?php else : ?>
                                                        <span style="color:red;">Barang telah terblokir</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <hr width="90%">
                                    <div class="row">
                                        <div class="col-lg-3 mb-3">
                                            <a href="user-item-add.php" class="btn btn-dark mt-1 tmb-barang">Tambah
                                                Barang</a>
                                        </div>

                                        <div class="pagination">
                                            <?php if ($halamanAktif1 > 1) : ?>
                                                <ul>
                                                    <li>
                                                        <a href="user-market-item.php?halamanBarang=<?= $halamanAktif1 - 1 ?>">&laquo;</a>
                                                    </li>
                                                </ul>
                                            <?php endif; ?>

                                            <?php for ($i = 1; $i <= $jumlahHalaman1; $i++) : ?>
                                                <?php if ($i == $halamanAktif1) : ?>
                                                    <li>
                                                        <a href="user-market-item.php?halamanBarang=<?= $i ?>" class="active"><?= $i ?></a>
                                                    </li>
                                                <?php else : ?>
                                                    <li>
                                                        <a href="user-market-item.php?halamanBarang=<?= $i ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endfor; ?>

                                            <?php if ($halamanAktif1 < $jumlahHalaman1) : ?>
                                                <ul>
                                                    <li>
                                                        <a href="user-market-item.php?halamanBarang=<?= $halamanAktif2 + 1 ?>">&raquo;</a>
                                                    </li>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-pembeli" role="tabpanel" aria-labelledby="pills-pembeli-tab">
                                    <div class="table-min">
                                        <?php if (isset($_SESSION["send"])) : ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success" role="alert">
                                                        Barang berhasil dikirim</div>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION["send"]); ?>
                                        <?php endif; ?>

                                        <?php if (isset($_SESSION["errorSend"])) : ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-danger" role="alert">
                                                        Barang gagal dikirim! pembeli belum bayar</div>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION["errorSend"]); ?>
                                        <?php endif; ?>

                                        <?php foreach ($pembelis as $pembeli) : ?>
                                            <section class="pembeli mb-3">
                                                <div class="row mb-3 prl-pembeli">
                                                    <div class="col-lg-5">
                                                        <a href="#"> <img src="../../../public_html/images/profile/<?= $pembeli['image']; ?>" class="ml-3 mr-2" width="30" alt="">
                                                            <p><?= $pembeli['name']; ?> </p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <a href="user-item-detail.php?id_item=<?= $pembeli['id_item']; ?>"><img src="../../../public_html/images/item/<?= $pembeli['item_image']; ?>" alt="..." class="img-thumbnail item-para"></a>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <h3 class="font-weight-bold"><?= $pembeli['item_name']; ?> </h3>
                                                        <p><?= $pembeli['item_type']; ?></p>
                                                        <p class="harga-para mt-4">Total Harga : Rp. <span class="harga-barang"><?= $pembeli['price_transaksi']; ?> </span></p>
                                                    </div>
                                                    <div class="col-lg-3 tngl-pembeli">
                                                        <p>Tanggal : </p>
                                                        <p><?= $pembeli['date_transaksi']; ?> </p>
                                                    </div>
                                                    <div class="col-lg-5 alamat-pembeli">
                                                        <p>Alamat Pembeli</p>
                                                        <textarea name="" id="" cols="30" rows="1" readonly><?= $pembeli['address']; ?> </textarea>
                                                        <?php if ($pembeli['payment_transaksi'] == 'pending') : ?>
                                                            <p>Status pembayaran <span style="color:red;">pending</span></p>
                                                        <?php else : ?>
                                                            <p>Status pembayaran <span style="color:green;">sukses</span></p>
                                                        <?php endif; ?>

                                                        <?php if ($pembeli['item_transaksi'] == 'pending') : ?>
                                                            <p>status barang <a href="user-market-buyer-send.php?id_transaksi=<?= $pembeli['id_transaksi']; ?>" style="color:blue">Kirim barang</a></p>
                                                        <?php else : ?>
                                                            <p>status barang <span style="color:green"><?= $pembeli['item_transaksi']; ?> </span></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </section>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="pagination">
                                        <?php if ($halamanAktif2 > 1) : ?>
                                            <ul>
                                                <li>
                                                    <a href="user-market-buyer.php?halamanPembeli=<?= $halamanAktif2 - 1 ?>">&laquo;</a>
                                                </li>
                                            </ul>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $jumlahHalaman2; $i++) : ?>
                                            <?php if ($i == $halamanAktif2) : ?>
                                                <li>
                                                    <a href="user-market-buyer.php?halamanPembeli=<?= $i ?>" class="active"><?= $i ?></a>
                                                </li>
                                            <?php else : ?>
                                                <li>
                                                    <a href="user-market-buyer.php?halamanPembeli=<?= $i ?>"><?= $i ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>

                                        <?php if ($halamanAktif2 < $jumlahHalaman2) : ?>
                                            <ul>
                                                <li>
                                                    <a href="user-market-buyer.php?halamanPembeli=<?= $halamanAktif2 + 1 ?>">&raquo;</a>
                                                </li>
                                            </ul>
                                        <?php endif; ?>
                                    </div>

                                </div>

                            </div>
                        </div>
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

    <script>
        new flickerplate('.flicker-example');

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>

    <script src="../../../public_html/vendors/sweetalert2-8.13.0/package/dist/sweetalert2.js"></script>
    <script>
        $(".hapus-para").on("click", function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Anda tidak dapat mengembalikan ini!",
                type: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
        });
    </script>

    <!-- My Script -->
    <script src="../../../public_html/js/script.js"></script>
</body>

</html>