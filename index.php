<?php

session_start();
require 'resources/config/functions.php';

$items = query("SELECT * FROM item_market LIMIT 0, 3");

?>

<!doctype html>
<html lang="en" id="home">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="public_html/vendors/bootstrap-4.3.1-dist/css/bootstrap.css">

    <!-- Font Awesome CSS -->
    <link type="text/css" rel="stylesheet" href="public_html/fonts/fontawesome-free/css/all.css">

    <!-- Slicknav CSS -->
    <link type="text/css" rel="stylesheet" href="public_html/vendors/slicknav/css/slicknav.min.css">

    <!-- Flickerplate CSS -->
    <link type="text/css" rel="stylesheet" href="public_html/vendors/Flickerplate/css/flickerplate.css">
    <link type="text/css" rel="stylesheet" href="public_html/vendors/Flickerplate/css/demo.css">
    <script src="public_html/vendors/Flickerplate/js/hammer-v2.0.3.js"></script>
    <script src="public_html/vendors/Flickerplate/js/flickerplate.js"></script>

    <!-- Sweetalert -->
    <link type="text/css" rel="stylesheet" href="public_html/vendors/sweetalert2-8.13.0/package/dist/sweetalert2.css">

    <!-- My CSS -->
    <link type="text/css" rel="stylesheet" href="public_html/css/style.css">

    <title>Chariot - Halaman Utama</title>
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
                            <a href="resources/pages/auth/login.php">Masuk</a>
                        </span>
                        <span class="toppbar-email ml-2">
                            <p> | </p>
                        </span>
                        <span class="topbar-email ml-2">
                            <a href="resources/pages/auth/regis.php">Daftar</a>
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
                                <a href="#home" class="site-logo page-scroll">
                                    <img src="public_html/images/material/logo.png" alt="">
                                </a>
                            </div>
                            <div class="col-xl-6 col-lg-5">
                                <form class="header-search-form">
                                    <input type="text" placeholder="Search on Chariot ....">
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
                            <li><a href="index.php">Beranda</a></li>
                            <li><a href="resources/pages/home/item.php?kategori=Adidas">Adidas</a></li>
                            <li><a href="resources/pages/home/item.php?kategori=New Balance">New Balance</a></li>
                            <li><a href="resources/pages/home/item.php?kategori=Nike">Nike</a></li>
                            <li><a href="resources/pages/home/item.php?kategori=Converse">Converse</a></li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
    </header>
    <!-- Akhir Navbar -->

    <!-- Carousel -->
    <section class="carousel">
        <div class="flicker-example">

            <ul>

                <li data-background="public_html/images/material/carousel-1.png">
                    <div class="flick-title">Flickerplate Is Working</div>
                    <div class="flick-sub-text">Heaven forbid this package you downloaded is broken. That wouldn't
                        be
                        embarrassing at all.</div>
                </li>

                <li data-background="public_html/images/material/carousel-2.png">
                    <div class="flick-title">Editable via Javascript or CSS</div>
                    <div class="flick-sub-text">Take a look at the extensive documentation to see how you can change
                        the
                        settings in multiple ways.</div>
                </li>

            </ul>

        </div>
    </section>
    <!-- Akhir Carousel -->

    <!-- Featured Brands -->
    <section class="featured-brand">
        <div class="row text-center">
            <div class="col-md">
                <h2>Featured Brand</h2>
            </div>
        </div>

        <div class="row text-center brand">
            <div class="col-lg-3 col-md-3 brad muncul">
                <a href="#" class="mtop"><img src="public_html/images/material/featured-addidas.png" alt=""></a>
            </div>
            <div class="col-lg-3 col-md-3 brad muncul">
                <a href="#" class="mtop"><img src="public_html/images/material/featured-nb.png" alt=""></a>
            </div>
            <div class="col-lg-3 col-md-3 brad muncul">
                <a href="#" class="mtop"><img src="public_html/images/material/featured-nike.png" alt=""></a>
            </div>
            <div class="col-lg-3 col-md-3 brad muncul">
                <a href="#" class="mtop"><img src="public_html/images/material/featured-coverse.png" alt=""></a>
            </div>
        </div>
    </section>
    <!-- Akhir Featured Brands -->

    <!-- Hot Product -->
    <section class="hot-product">
        <div class="row text-center">
            <div class="col-md">
                <h2>Hot Produk</h2>
            </div>
        </div>

        <div class="row item text-center tampil">
            <?php foreach ($items as $item) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="img-hover-zoom img-hover-zoom--colorize img mx-auto">
                        <a href="" class="login-duls"><img src="public_html/images/item/<?= $item['item_image']; ?>" class="box" alt="Another Image zoom-on-hover effect"></a>
                        <div class="rinci">
                            <h4><?= $item['item_name']; ?> </h4>
                            <hr>
                            <p><?= $item['item_type']; ?> </p>
                            <a href="#">Rp. <?= $item['item_price']; ?> </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-5 text-center">
                <a href="resources/pages/home/item.php" class="load-more">Lihat Lebih Banyak</a>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-5 text-center">
                <a href="resources/pages/home/item.php" class=""><img src="public_html/images/material/load-more.png" alt=""></a>
            </div>
        </div>
    </section>
    <!-- Akhir Hot Product -->

    <!-- Load More -->
    <section class="promo">
        <div class="row text-center">
            <div class="col-lg-12 col-md-12 kanan tampul">
                <a href="#"><img src="public_html/images/material/promo-1.png" alt=""></a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-lg-12 col-md-12 mt-5 kiri tampul">
                <a href="#"><img src="public_html/images/material/promo-2.png" alt=""></a>
            </div>
        </div>
    </section>
    <!-- Akhir Load More -->

    <!-- Footer -->
    <section class="footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <a href="index.php"><img src="public_html/images/material/logo.png" alt=""></a>
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
    <script src="public_html/vendors/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="public_html/vendors/bootstrap-4.3.1-dist/js/bootstrap.js"></script>

    <!-- Vendor -->
    <script src="public_html/vendors/slicknav/js/jquery.slicknav.min.js"></script>
    <script>
        new flickerplate('.flicker-example');
    </script>

    <script src="public_html/vendors/sweetalert2-8.13.0/package/dist/sweetalert2.js"></script>
    <script>
        $(".login-duls").on("click", function(e) {
            e.preventDefault();
            Swal.fire({
                type: 'warning',
                title: 'Perhatian',
                text: 'login terlebih dahulu sebelum memesan!',
                footer: 'Terima kasih'
            });
        });
    </script>
    <script src="public_html/vendors/jquery.easing.1.3/jquery.easing.1.3.js"></script>

    <!-- My Script -->
    <script src="public_html/js/script.js"></script>
</body>

</html>