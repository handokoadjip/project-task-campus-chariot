<?php

session_start();
require '../../config/functions.php';

if (isset($_POST['regis'])) {
    $error = [];

    if (empty($_POST['name'])) {
        $error['name'] = 'Nama tidak boleh kosong';
    }
    if (empty($_POST['email'])) {
        $error['email'] = 'Email tidak boleh kosong';
    }
    if (empty($_POST['password1'])) {
        $error['password1'] = 'Passowrd tidak boleh kosong';
    }
    if (empty($_POST['password2'])) {
        $error['password2'] = 'Ulangi Passowrd tidak boleh kosong';
    }
    if (empty($_POST['birth'])) {
        $error['birth'] = 'Tgl lahir tidak boleh kosong';
    }
    if (empty($_POST['no_telp'])) {
        $error['no_telp'] = 'No Telp/HP tidak boleh kosong';
    }
    if (empty($_POST['address'])) {
        $error['address'] = 'Alamat tidak boleh kosong';
    }
}

if (isset($_POST['regis']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['no_telp']) && !empty($_POST['address'])) {
    if (regis($_POST) > 0) {
        header('Location: regis-notif.php');
    } else {
        echo mysqli_error($conn);
    }
}

if (isset($_POST['login'])) {
    $error = [];

    if (empty($_POST['email-login'])) {
        $error['email-login'] = 'Email tidak boleh kosong';
    }

    if (empty($_POST['password-login'])) {
        $error['password-login'] = 'Password tidak boleh kosong';
    }
}

if (isset($_POST['login']) && !empty($_POST['email-login']) && !empty($_POST['password-login'])) {
    if (login($_POST) == 0) {
        $error = true;
    } else if (login($_POST) == 1) {
        $errorEmail = true;
    } else if (login($_POST) == 2) {
        $errorActiv = true;
    } else if (login($_POST) == 3) {
        $errorPassword = true;
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

    <title>Chariot - Masuk</title>
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
                            <a href="login.php">Masuk</a>
                        </span>
                        <span class="toppbar-email ml-2">
                            <p> | </p>
                        </span>
                        <span class="topbar-email ml-2">
                            <a href="regis.php">Daftar</a>
                        </span>
                    </div>
                </div>
                <div class="topbar-child1">
                    <span class="topbar-email ml-2">
                        <i class="far fa-question-circle"></i>
                    </span>
                    <span class="topbar-email ml-2">
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
                                <a href="../../../index.php" class="site-logo">
                                    <img src="../../../public_html/images/material/logo.png" alt="">
                                </a>
                            </div>
                            <div class="col-xl-6 col-lg-5">
                                <form class="header-search-form">
                                    <input type="text" placeholder="Search on Chariot ...." autocomplete="off">
                                    <button><i class="fab fa-searchengin"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <!-- menu -->
                        <ul class="main-menu">
                            <li><a href="../../../index.php">Beranda</a></li>
                            <li><a href="../home/item.php?kategori=Adidas">Addidas</a></li>
                            <li><a href="../home/item.php?kategori=New Balance">New Balance</a></li>
                            <li><a href="../home/item.php?kategori=Nike">Nike</a></li>
                            <li><a href="../home/item.php?kategori=Converse">Converse</a></li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
    </header>
    <!-- Akhir Navbar -->

    <!-- Login-system -->
    <div class="login-system">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 bg-login-system">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="col-12">
                            <!-- Menu Atas -->
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active antri-pesan" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                        <h4>Masuk</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link batal-pesan" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                        <h4>Daftar</h4>
                                    </a>
                                </li>
                            </ul>
                            <!-- Akhir Menu Atas -->

                            <!-- Isi Menu Atas -->
                            <div class="tab-content" id="pills-tabContent">
                                <!-- Login -->
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="row">
                                        <center>
                                            <div class="col-md-12 teks">
                                                <h3 class="mb-3">Masuk ke akun Anda</h3>
                                                <p>Kami tidak akan posting</p>
                                                <p>atas nama Anda atau membagikan</p>
                                                <p class="mb-5"> informasi apapun tanpa persetujuan Anda.</p>
                                                <h5>Masuk</h5>
                                                <hr>
                                            </div>
                                        </center>
                                        <div class="col-md-8 form-log mt-5">
                                            <form action="" method="post">
                                                <?php if (isset($errorEmail)) : ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        Email belum terdaftar!</div>
                                                <?php endif; ?>

                                                <?php if (isset($errorActiv)) : ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        Akun Telah diblokir!</div>
                                                <?php endif; ?>

                                                <?php if (isset($errorPassword)) : ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        Password salah!</div>
                                                <?php endif; ?>
                                                <div class="form-group">
                                                    <label for="email-login">Alamat Email</label>
                                                    <input type="email" class="form-control" id="email-login" name="email-login" autocomplete="off">
                                                    <small class="text-danger pl-3"><?= isset($error['email-login']) ? $error['email-login'] : '';  ?></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password-email" class="mt-3">Password</label>
                                                    <input type="password" class="form-control" id="password-email" name="password-login" autocomplete="off">
                                                    <small class="text-danger pl-3"><?= isset($error['password-login']) ? $error['password-login'] : '';  ?></small>
                                                </div>
                                                <a href="#" class="float-right">Lupa
                                                    Password?</a>
                                                <br>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="ingat-saya" name="remember" autocomplete="off">
                                                    <label class="form-check-label" for="ingat-saya">ingat saya</label>
                                                </div>
                                                <button type="submit" class="btn-login mt-3 mb-5" name="login">Login</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Login -->

                                <!-- Daftar -->
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="row">
                                        <center>
                                            <div class="col-md-12 teks">
                                                <h3 class="mb-3">Daftar akun Anda</h3>
                                                <p>Kami tidak akan posting</p>
                                                <p>atas nama Anda atau membagikan</p>
                                                <p class="mb-5"> informasi apapun tanpa persetujuan Anda.</p>
                                                <h5>Daftar</h5>
                                                <hr>
                                            </div>
                                        </center>
                                        <div class="col-md-8 form-log mt-5">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label for="nama-lengkap">Nama Lengkap </label>
                                                    <input type="text" class="form-control" id="nama-lengkap" name='name' autocomplete="off">
                                                    <small class="text-danger pl-3"><?= isset($error['name']) ? $error['name'] : '';  ?></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email-regis" class="mt-3">Alamat Email</label>
                                                    <input type="text" class="form-control" id="email-regis" name="email" autocomplete="off">
                                                    <small class="text-danger pl-3"><?= isset($error['email']) ? $error['email'] : '';  ?></small>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6 mt-3">
                                                        <label for="password1">Password</label>
                                                        <input type="password" class="form-control" id="password1" name="password1" autocomplete="off">
                                                        <small class="text-danger pl-3"><?= isset($error['password1']) ? $error['password1'] : '';  ?></small>
                                                    </div>
                                                    <div class="form-group col-md-6 mt-3">
                                                        <label for="password2">Ulangi password</label>
                                                        <input type="password" class="form-control" id="password2" name="password2" autocomplete="off">
                                                        <small class="text-danger pl-3"><?= isset($error['password2']) ? $error['password2'] : '';  ?></small>
                                                    </div>
                                                    <fieldset class="form-group">
                                                        <div class="row">
                                                            <legend class="col-form-label col-sm pt-0 mt-3">Gender
                                                            </legend>
                                                            <div class="col-sm-7">
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" name="gender" value="L" id="gender1" checked>
                                                                    <label class="form-check-label" for="gender1">
                                                                        Pria
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" name="gender" value="P" id="gender2">
                                                                    <label class="form-check-label" for="gender2">
                                                                        Wanita
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form-group mr-2">
                                                        <label for="tanggal" class="mt-3">Tanggal Lahir : </label>
                                                        <input type="date" class="form-control" id="tanggal" name="birth">
                                                        <small class="text-danger pl-3"><?= isset($error['birth']) ? $error['birth'] : '';  ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="no-hp" class="mt-3">Nomor Telp</label>
                                                        <input type="tel" class="form-control" id="no-hp" name="no_telp" autocomplete="off">
                                                        <small class="text-danger pl-3"><?= isset($error['no_telp']) ? $error['no_telp'] : '';  ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat" class="mt-3">Alamat</label>
                                                        <textarea class="form-control" id="alamat" rows="3" cols="80" name="address"></textarea>
                                                    </div>
                                                    <small class="text-danger pl-3"><?= isset($error['address']) ? $error['address'] : '';  ?></small>
                                                </div>
                                                <button type="submit" class="btn-login mt-3 mb-5" name="regis">Daftar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Daftar -->
                            </div>
                            <!-- Akhir Isi Menu Atas -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Login System -->

    <!-- Footer -->
    <section class="footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <a href=""><img src="../../../public_html/images/material/logo.png" alt=""></a>
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
                    <a class="mt-2" href="">Konfirmasi Transfer</a>
                    <a href="">Hubungi Kami</a>
                    <a href="">Bantuan</a>
                    <a href="">Status Order</a>
                    <a href="">Pengembalian</a>
                    <a href="">Cara Penjualan</a>
                </div>
                <div class="col-lg-3 block-a rights col-md-6">
                    <h4 class="foot-sub">Tentang Kami</h4>
                    <a class="mt-2" href="">About Us</a>
                    <a href="">Peomosi Brand</a>
                    <a href="">Karir</a>
                    <a href="">THREAD by Chariot</a>
                </div>
            </div>


            <div class="row justify-content-between mt-5">
                <div class="col-lg-5 col-md-6">
                    <p>Anda punya pertanyaan? kami siap membantu</p>
                    <a href="" class="hov">Kontak</a> <strong class="mx-2">|</strong> <a href="" class="hov">Customer
                        Information</a>
                </div>
                <div class="col-lg-6 rights col-md-6">
                    <a href="">Tentang Chariot</a> <strong class="mx-2">|</strong> <a href="">Kebijakan Privasi</a>
                    <strong class="mx-2">|</strong> <a href="">Syarat
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