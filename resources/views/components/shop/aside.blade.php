<aside class="off-canvas-wrapper">
    <div class="off-canvas-overlay"></div>
    <div class="off-canvas-inner-content">
        <div class="btn-close-off-canvas">
            <i class="lnr lnr-cross"></i>
        </div>

        <div class="off-canvas-inner">
            <!-- search box start -->
            <div class="search-box-offcanvas">
                <form method="get" action="produk.php">
                    <input type="text" name="s" placeholder="Tulis yang kamu fikirkan..">
                    <button class="search-btn" type="submit"><i class="lnr lnr-magnifier"></i></button>
                </form>
            </div>
            <!-- search box end -->

            <!-- mobile menu start -->
            <div class="mobile-navigation">

                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu">

                        <li class="active"><a href="index.php">Beranda</a></li>
                        <li class="menu-item-has-children">
                            <a href="kategori.php">Kategori</a>
                            <ul class="dropdown">
                                {{-- <?php
                                $m_kategori = mysqli_query($koneksi, 'SELECT * FROM kategori');
                                while ($d_kategori = mysqli_fetch_assoc($m_kategori)) {
                                    echo "<li><a href='kategori.php?q=$d_kategori[kategori_id]'>$d_kategori[kategori_nama]</a></li>";
                                }
                                ?> --}}
                            </ul>
                        </li>
                        <li><a href="produk.php">Produk</a></li>
                        <li><a href="tentang-kami.php">Tentang Kami</a></li>
                        <li class="mega-title menu-item-has-children"><a href="#">Akun</a>
                            <ul class="dropdown">
                                {{-- <?php if (isset($_SESSION['masuk'])) { ?>
                                <li><a href="my-account.php">my account</a></li>
                                <li><a href="logout.php">Logout</a></li>
                                <?php } else { ?>
                                <li><a href="login-register.php">login</a></li>
                                <li><a href="login-register.php">register</a></li>
                                <?php } ?> --}}
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->

        </div>
    </div>
</aside>
