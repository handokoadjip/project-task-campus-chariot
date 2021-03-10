(function ($) {
  var posWrapHeader = $(".topbar").height();
  var header = $(".container-menu-header");

  // Event link scroll
  $(".page-scroll").on("click", function (e) {
    // mengambil page scroll href dengan this
    var tujuan = $(this).attr("href");
    // console.log(tujuan);

    // mengambil semua element href

    var elemenTujuan = $(tujuan);
    // console.log(elemenTujuan);
    // console.log(elemenTujuan);

    // scroll
    $("html, body").animate(
      {
        scrollTop: elemenTujuan.offset().top - 50,
      },
      1250,
      "easeInOutExpo"
    );
    // mematikan href
    e.preventDefault();
  });

  $(window).on("scroll", function () {
    if ($(this).scrollTop() >= posWrapHeader) {
      $(".header1").addClass("fixed-header");
      $(header).css("top", -posWrapHeader);
    } else {
      var x = -$(this).scrollTop();
      $(header).css("top", x);
      $(".header1").removeClass("fixed-header");
    }

    if ($(this).scrollTop() >= 200 && $(window).width() > 992) {
      $(".fixed-header2").addClass("show-fixed-header2");
      $(".header2").css("visibility", "hidden");
      $(".header2")
        .find(".header-dropdown")
        .removeClass("show-header-dropdown");
    } else {
      $(".fixed-header2").removeClass("show-fixed-header2");
      $(".header2").css("visibility", "visible");
      $(".fixed-header2")
        .find(".header-dropdown")
        .removeClass("show-header-dropdown");
    }

    var wScroll = $(this).scrollTop();

    // if ($(".featured-brand")[0]) {
    //   if (wScroll > $(".featured-brand").offset().top - 200) {
    //     $(".featured-brand .brand .brad").each(function (i) {
    //       setTimeout(function () {
    //         $(".featured-brand .brand .brad").eq(i).addClass("muncul");
    //       }, 300 * i);
    //     });
    //   } else {
    //     $(".featured-brand .brand .brad").each(function (i) {
    //       setTimeout(function () {
    //         $(".featured-brand .brand .brad").eq(i).removeClass("muncul");
    //       }, 300 * i);
    //     });
    //   }
    // }

    // if ($(".hot-product")[0]) {
    //   if (wScroll > $(".hot-product").offset().top - 200) {
    //     $(".item").addClass("tampil");
    //   } else {
    //     $(".item").removeClass("tampil");
    //   }
    // }

    // if ($(".promo")[0]) {
    //   if (wScroll > $(".promo").offset().top - 200) {
    //     $(".promo .kiri").addClass("tampul");
    //     $(".promo .kanan").addClass("tampul");
    //   } else {
    //     $(".promo .kiri").removeClass("tampul");
    //     $(".promo .kanan").removeClass("tampul");
    //   }
    // }
  });

  /*------------------
		DIVISIMA
		NAVIGATION
	--------------------*/
  $(".main-menu").slicknav({
    prependTo: ".main-navbar .container",
    closedSymbol: '<i class="flaticon-right-arrow"></i>',
    openedSymbol: '<i class="flaticon-down-arrow"></i>',
  });
})(jQuery);
