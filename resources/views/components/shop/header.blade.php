<header class="header-area">
    <!-- main header start -->
    <div class="main-header d-none d-lg-block">
        <!-- header top start -->
        <div class="header-top bdr-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="welcome-message">
                            <p>Selamat datang di Rentaru Digital Printing</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="header-top-settings">
                            <ul class="nav align-items-center justify-content-end">
                                <li class="contact us">
                                    <span><a href="kontak-kami.php">Kontak Kami</a></span>
                                </li>
                                <li class="curreny-wrap">
                                    <?php if (isset($_SESSION['masuk'])) { ?>
                                    <span><a href="logout.php">Logout</a></span>
                                    <?php } else { ?>
                                    <span><a href="login-register.php">Daftar Akun</a></span>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header top end -->

        <!-- header middle area start -->
        <div class="header-main-area sticky">
            <div class="container">
                <div class="row align-items-center position-relative">

                    <!-- start logo area -->
                    <div class="col-lg-3">
                        <div class="logo">
                            <a href="index.php">
                                <img src="assets/img/logo/logo2.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- start logo area -->

                    <!-- main menu area start -->
                    <div class="col-lg-6 position-static">
                        <div class="main-menu-area">
                            <div class="main-menu">
                                <!-- main menu navbar start -->
                                <nav class="desktop-menu">
                                    <ul>
                                        <li class="active"><a href="{{ route('shop-index') }}">Beranda</a></li>
                                        <li>
                                            <a href="">Kategori <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                @foreach ($kategoris as $kategori)
                                                    <li><a
                                                            href="{{ route('satu-kategori', ['slug' => $kategori->kategori_nama]) }}">{{ $kategori->kategori_nama }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="produk.php">Produk</a></li>
                                        <li><a href="tentang-kami.php">Tentang Kami</a></li>
                                    </ul>
                                </nav>
                                <!-- main menu navbar end -->
                            </div>
                        </div>
                    </div>
                    <!-- main menu area end -->

                    <!-- mini cart area start -->
                    <div class="col-lg-3">
                        <div class="header-configure-wrapper">
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <li>
                                        <a href="#" class="offcanvas-btn">
                                            <i class="lnr lnr-magnifier"></i>
                                        </a>
                                    </li>
                                    <li class="user-hover">
                                        <a href="#">
                                            <i class="lnr lnr-user"></i>
                                        </a>
                                        <ul class="dropdown-list">
                                            {{-- <?php if (isset($_SESSION['masuk'])) { ?>
                                            <li><a href="my-account.php">my account</a></li>
                                            <li><a href="logout.php">Logout</a></li>
                                            <?php } else { ?>
                                            <li><a href="login-register.php">login</a></li>
                                            <li><a href="login-register.php">register</a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <?php if (isset($_SESSION['masuk'])) {
                  $cart = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM cart where cart_customer='$_SESSION[customer_id]'"));
                ?>
                                    <li>
                                        <a href="#" class="minicart-btn">
                                            <i class="lnr lnr-cart"></i>
                                            <?php if ($cart > 0) { ?>
                                            <div class="notification"><?= $cart ?></div>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <?php } ?> --}}
                                        </ul>
                            </div>
                        </div>
                    </div>
                    <!-- mini cart area end -->

                </div>
            </div>
        </div>
        <!-- header middle area end -->
    </div>
    <!-- main header start -->

    <!-- mobile header start -->
    <div class="mobile-header d-lg-none d-md-block sticky">
        <!--mobile header top start -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="mobile-main-header">
                        <div class="mobile-logo">
                            <a href="index.php">
                                <img src="assets/img/logo/logo2.png" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="mobile-menu-toggler">
                            <div class="mini-cart-wrap">
                                <a href="cart.php">
                                    <i class="lnr lnr-cart"></i>
                                </a>
                            </div>
                            <div class="mobile-menu-btn">
                                <div class="off-canvas-btn">
                                    <i class="lnr lnr-menu"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile header top start -->
    </div>
    <!-- mobile header end -->
</header>
