<?php

session_start();
require '../../config/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE email = '$email' ")[0];

if (isset($_POST['changePassword'])) {
    $error = [];

    if (empty($_POST['password1'])) {
        $error['password1'] = 'Password lama tidak boleh kosong';
    }

    if (empty($_POST['password2'])) {
        $error['password2'] = 'Password baru tidak boleh kosong';
    }

    if (empty($_POST['password3'])) {
        $error['password3'] = 'Ulangi password tidak boleh kosong';
    }
}

if (isset($_POST['changePassword']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['password3'])) {
    if (changePassword($_POST) == 3) {
        $notif = true;
        $_SESSION['notif'] = $notif;

        header("Location: user-logout.php");
    } else if (changePassword($_POST) == 0) {
        $error = true;
        $_SESSION['error'] = $error;
    } else if (changePassword($_POST) == 1) {
        $errorPassword = true;
        $_SESSION['errorPassword'] = $errorPassword;
    } else if (changePassword($_POST) == 2) {
        $errorNotSame = true;
        $_SESSION['errorNotSame'] = $errorNotSame;
    } else if (changePassword($_POST) == 4) {
        $errorNotSame = true;
        $_SESSION['errorNotSamePassword'] = $errorNotSamePassword;
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

    <title>Chariot - Ubah Kata Sandi</title>
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
                    <h2 class="mt-4">Ganti Password</h2>
                </div>
            </div>
            <!-- Menu -->
            <div class="row">
                <div class="col-2">
                    <section class="kanan">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active mb-2" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Akun
                                Saya</a>
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
                                        <a class="nav-link active profile-akun" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ganti Kata Sandi
                                            <p>Kelola informasi anda untuk mengontrol, melindungi, dan mengamankan akun
                                                anda</p>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Akhir Menu Atas -->

                                <!-- Isi Menu Atas -->
                                <form action="" method="post">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <?php if (isset($_SESSION['error'])) : ?>
                                                        <div class="alert alert-danger" role="alert" style="width: 546px">
                                                            Gagal ganti password!</div>
                                                        <?php unset($_SESSION['error']); ?>
                                                    <?php endif; ?>

                                                    <?php if (isset($_SESSION['errorPassword'])) : ?>
                                                        <div class="alert alert-danger" role="alert" style="width: 546px">
                                                            Password lama salah!</div>
                                                        <?php unset($_SESSION['errorPassword']); ?>
                                                    <?php endif; ?>

                                                    <?php if (isset($_SESSION['errorNotSame'])) : ?>
                                                        <div class="alert alert-danger" role="alert" style="width: 546px">
                                                            Password baru dan sekarang tidak boleh sama!</div>
                                                        <?php unset($_SESSION['errorNotSame']); ?>
                                                    <?php endif; ?>

                                                    <?php if (isset($_SESSION['errorNotSamePassword'])) : ?>
                                                        <div class="alert alert-danger" role="alert" style="width: 546px">
                                                            Password baru dan Ulangi Password tidak sama!</div>
                                                        <?php unset($_SESSION['errorNotSamePassword']); ?>
                                                    <?php endif; ?>

                                                    <?php if (isset($_SESSION['notif'])) : ?>
                                                        <div class="alert alert-success" role="alert" style="width: 546px">
                                                            Password berhasil diganti!</div>
                                                        <?php unset($_SESSION['notif']); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8 profiles-edit-parent">
                                                    <div class="form-group row profiles-edit">
                                                        <label for="passwordLama3" class="col-sm-4 col-form-label">Password Lama</label>
                                                        <div class="col-sm-7">
                                                            <input type="password" class="form-control" id="passwordLama3" name="password1" autocomplete="off">
                                                            <small class="text-danger pl-3"><?= isset($error['password1']) ? $error['password1'] : '';  ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row profiles-edit">
                                                        <label for="passwordBaru3" class="col-sm-4 col-form-label">Password Baru</label>
                                                        <div class="col-sm-7">
                                                            <input type="password" class="form-control" id="passwordBaru3" name="password2" autocomplete="off">
                                                            <small class="text-danger pl-3"><?= isset($error['password2']) ? $error['password2'] : '';  ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row profiles-edit">
                                                        <label for="ulangiPassword3" class="col-sm-4 col-form-label">Ulangi Password</label>
                                                        <div class="col-sm-7">
                                                            <input type="password" class="form-control" id="ulangiPassword3" name="password3" autocomplete="off">
                                                            <small class="text-danger pl-3"><?= isset($error['password3']) ? $error['password3'] : '';  ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button class="btn btn-warning font-weight-bold mt-5" name="changePassword">Simpan</button>
                                                    <a href="user-index.php" class="btn btn-danger mt-5">Kembali</a>
                                                </div>
                                            </div>
                                        </div>
                                </form>
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
                                <div class="row">
                                    <div class="col-lg-2">
                                        <a href="rinci-barang.html"><img src="images/item/jual-1.png" alt="..." class="img-thumbnail item-para"></a>
                                    </div>
                                    <div class="col-lg-3">
                                        <h3 class="font-weight-bold">Addidas</h3>
                                        <p>Superstart white</p>
                                        <p class="harga-para mt-4">Harga : Rp. <span class="harga-barang">200000</span>
                                        </p>
                                    </div>
                                    <div class="col-lg-3">
                                        <p class="stock-para">Stock <span class="harga-barang">20</span></p>
                                    </div>
                                    <div class="col-lg-3 aksi-para">
                                        <a href="tambah-barang.html" class="edit-para">Edit</a>
                                        <a href="#" class="hapus-para">Hapus</a>
                                    </div>
                                </div>
                                <hr width="90%">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <a href="tambah-barang.html" class="btn btn-dark mt-1 tmb-barang">Tambah
                                            Barang</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-pembeli" role="tabpanel" aria-labelledby="pills-pembeli-tab">
                                <section class="pembeli">
                                    <div class="row mb-3 prl-pembeli">
                                        <div class="col-lg-5">
                                            <a href="#"> <img src="images/profile/5.jpg" class="ml-3 mr-2" width="30" alt="">
                                                <p>User</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <a href="rinci-barang.html"><img src="images/item/jual-1.png" alt="..." class="img-thumbnail item-para"></a>
                                        </div>
                                        <div class="col-lg-2">
                                            <h3 class="font-weight-bold">Addidas</h3>
                                            <p>Superstart white</p>
                                            <p class="harga-para mt-4">Harga : Rp. <span class="harga-barang">200000</span></p>
                                        </div>
                                        <div class="col-lg-3 tngl-pembeli">
                                            <p>Tanggal : </p>
                                            <p>10 Desember 2019 </p>
                                        </div>
                                        <div class="col-lg-5 alamat-pembeli">
                                            <p>Alamat Pembeli</p>
                                            <textarea name="" id="" cols="30" rows="1" readonly></textarea>
                                            <p>status pembayaran</p>
                                            <p>status barang</p>
                                        </div>
                                    </div>
                                </section>
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

    <!-- My Script -->
    <script src="../../../public_html/js/script.js"></script>
</body>

</html>