<?php

session_start();
require '../../config/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE email = '$email'")[0];

if (isset($_POST['editProfile'])) {
    $error = [];

    if (empty($_POST['name_user'])) {
        $error['name_user'] = 'Nama tidak boleh kosong';
    }

    if (empty($_POST['address_user'])) {
        $error['address_user'] = 'Alamat tidak boleh kosong';
    }
}

if (isset($_POST["editProfile"]) && !empty($_POST['name_user']) && !empty($_POST['address_user'])) {
    if (editProfile($_POST) > 0) {
        header("Location: user-profile.php");
        $_SESSION["profile"] = true;
    } else {
        $_SESSION["notChange"] = true;
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

    <title>Chariot - Ubah Profile</title>
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

    <!-- Edit Profile -->
    <div class="profile">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4">
                    <h2 class="mt-4">Ubah Profile</h2>
                </div>
            </div>
            <!-- Menu -->
            <div class="row">
                <!-- Menu Kanan -->
                <div class="col-2">
                    <section class="kanan">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active mb-2" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Akun
                                Saya</a>
                        </div>
                    </section>
                </div>
                <!-- Akhir Menu-Kanan -->
                <div class="col-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <!-- Pesanan Saya -->
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="col-12">
                                <!-- Menu Atas -->
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active profile-akun" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ubah Profile Anda
                                            <p>Kelola informasi anda untuk mengontrol, melindungi, dan mengamankan akun
                                                anda</p>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Akhir Menu Atas -->

                                <!-- Isi Menu Atas -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <!-- Hidden Input -->
                                    <input type="hidden" name="gender_user" value="<?= $user['gender']; ?>">
                                    <input type="hidden" name="password_user" value="<?= $user['password']; ?>">
                                    <input type="hidden" name="role_user" value="<?= $user['role_id']; ?>">
                                    <input type="hidden" name="active_user" value="<?= $user['is_active']; ?>">
                                    <input type="hidden" name="date_user" value="<?= $user['date_created']; ?>">
                                    <input type="hidden" name="old_image" value="<?= $user['image']; ?>">
                                    <!-- Akhir Hidden Input -->
                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- Akun Saya -->
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="alert alert-danger" role="alert">
                                                            Yang diupload bukan gambar</div>
                                                    </div>
                                                </div>
                                                <?php unset($_SESSION["fileEkstensi"]); ?>
                                            <?php endif; ?>

                                            <?php if (isset($_SESSION["notChange"])) : ?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="alert alert-danger" role="alert">
                                                            Tidak ada yang diubah</div>
                                                    </div>
                                                </div>
                                                <?php unset($_SESSION["notChange"]); ?>
                                            <?php endif; ?>

                                            <?php if (isset($_SESSION["fileSize"])) : ?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="alert alert-danger" role="alert">
                                                            File Terlalu Besar. Max 2MB</div>
                                                    </div>
                                                </div>
                                                <?php unset($_SESSION["fileSize"]); ?>
                                            <?php endif; ?>
                                            <div class="row">
                                                <div class="col-lg-6 profiles-edit-parent">
                                                    <div class="form-group row profiles-edit">
                                                        <label for="nama3" class="col-sm-4 col-form-label">Nama
                                                            Lengkap</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="nama3" value="<?= $user['name']; ?>" name="name_user" autocomplete="off">
                                                            <small class="text-danger pl-3"><?= isset($error['name_user']) ? $error['name_user'] : '';  ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row profiles-edit">
                                                        <label for="email3" class="col-sm-4 col-form-label">Email</label>
                                                        <div class="col-sm-8">
                                                            <input type="email" class="form-control" id="email3" value="<?= $user['email']; ?>" name="email_user" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row profiles-edit">
                                                        <label for="noTelp3" class="col-sm-4 col-form-label">Nomor
                                                            Telp/HP</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="noTelp3" value="<?= $user['no_telp']; ?>" name="no_user" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row profiles-edit">
                                                        <label for="tngl3" class="col-sm-4 col-form-label">Tanggal
                                                            Lahir</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control" id="tngl3" value="<?= $user['birth']; ?>" name="birth_user">
                                                            <small class="text-danger pl-3"><?= isset($error['birth_user']) ? $error['birth_user'] : '';  ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group profiles-edit">
                                                        <label for="alamat1">Alamat</label>
                                                        <textarea class="form-control" id="alamat1" rows="4" name="address_user"><?= $user['address']; ?></textarea>
                                                        <small class="text-danger pl-3"><?= isset($error['address_user']) ? $error['address_user'] : '';  ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-lg-6 profiles-edit-parent">
                                                            <img src="../../../public_html/images/profile/<?= $user['image']; ?>" alt="..." class="img-thumbnail">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile" name="image_user">
                                                                <label class="custom-file-label" for="customFile">Pilih
                                                                    Gambar</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button class="btn btn-warning font-weight-bold mt-5 mr-2" name="editProfile">Simpan</button>
                                                    <a href="user-profile.php" class="btn btn-danger font-weight-bold mt-5 color-white">Kembali</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Akun Saya -->
                                </form>
                            </div>
                            <!-- Akhir Isi Menu Atas -->
                        </div>
                    </div>
                    <!-- Akhir Pesanan Saya -->
                </div>
            </div>
            <!-- Akhir Menu -->
        </div>
    </div>
    </div>
    <!-- Akhir Edit Profile -->

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

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>

    <!-- My Script -->
    <script src="../../../public_html/js/script.js"></script>
</body>

</html>