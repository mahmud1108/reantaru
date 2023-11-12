<footer class="footer-wrapper">
    <!-- footer widget area start -->
    <div class="footer-widget-area">
        <div class="container">
            <div class="footer-widget-inner section-space">
                <div class="row mbn-30">
                    <!-- footer widget item start -->
                    <div class="col-lg-8 col-md-6 col-sm-8">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-title">
                                <h5>Akun Kami</h5>
                            </div>
                            <ul class="footer-widget-body accout-widget">
                                <li class="address">
                                    <em><i class="lnr lnr-map-marker"></i></em>
                                    Jl. Raya Prembun, Kaliworo, Kaliwiro, Kec. Kaliwiro, Kabupaten Wonosobo, Jawa
                                    Tengah 56364
                                </li>
                                <li class="email">
                                    <em><i class="lnr lnr-envelope"></i>Mail: </em>
                                    <a href="mailto:test@yourdomain.com">annisaindahlesta@gmail.com</a>
                                </li>
                                <li class="phone">
                                    <em><i class="lnr lnr-phone-handset"></i> Nomor Hp: </em>
                                    <a
                                        href="https://wa.me/088227874658?text=Halo%20saya%20ingin%20bertanya%20tentang%20produk%20Anda.%0ASilakan%20balas%20segera.">+62
                                        882-2787-4658</a>
                                </li>
                            </ul>
                            <div class="payment-method">
                                <img src="assets/img/payment-pic.png" alt="payment method">
                            </div>
                        </div>
                    </div>
                    <!-- footer widget item end -->

                    <!-- footer widget item start -->
                    <div class="col-lg-2 col-md-6 col-sm-4">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-title">
                                <h5>Kategori</h5>
                            </div>
                            <ul class="footer-widget-body">
                                @foreach ($kategoris as $kategori)
                                    <li><a
                                            href='kategori.php?q=$d_kategori[kategori_id]'>{{ $kategori->kategori_nama }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- footer widget item end -->

                    <!-- footer widget item start -->
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-title">
                                <h5>Informasi</h5>
                            </div>
                            <ul class="footer-widget-body">
                                <li><a href="index.php">Beranda</a></li>
                                <li><a href="tentang-kami.php">Tentang Kami</a></li>
                                <li><a href="kontak-kami.php">Kontak Kami</a></li>
                                <li><a href="login-register.php">Register</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- footer widget item end -->
                </div>
            </div>
        </div>
    </div>
    <!-- footer widget area end -->

    <!-- footer bottom area start -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="copyright-text">
                        <p>Copyright ©All Right Reserved.</p>
                    </div>
                </div>
                <div class="col-md-6 order-1 order-md-2">
                    <div class="footer-social-link">
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom area end -->

</footer>
