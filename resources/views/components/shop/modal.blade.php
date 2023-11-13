<!-- Quick view modal start -->
<div class="modal" id="quick_view">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- product details inner end -->
                <div class="product-details-inner">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="product-large-slider" id="container_gambar">
                                <div class="pro-large-img">
                                </div>
                            </div>
                            <div class="pro-nav slick-row-10 slick-arrow-style">
                                <div class="pro-nav-thumb" id="container_gambar_list">
                                    <img src="assets/img/product/product-details-img1.jpg" alt="product-details" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7">
                            <div class="product-details-des quick-details">
                                <h3 class="product-name" id="produk_nama"></h3>
                                <div class="price-box">
                                    <span class="price-regular" id="produk_harga"></span>
                                </div>
                                <div class="availability">
                                    <i class="fa fa-check-circle"></i>
                                    <span id='produk_kategori'></span>
                                </div>
                                <span class="pro-desk" id="produk_keterangan"></span>
                                <div class="quantity-cart-box d-flex align-items-center">
                                    <div class="action_link">
                                        <a class="btn btn-cart2" href="#">Beli</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- product details inner end -->
            </div>
        </div>
    </div>
</div>
<!-- Quick view modal end -->

<!-- offcanvas search form start -->
<div class="offcanvas-search-wrapper">
    <div class="offcanvas-search-inner">
        <div class="offcanvas-close">
            <i class="lnr lnr-cross"></i>
        </div>
        <div class="container">
            <div class="offcanvas-search-box">
                <form class="d-flex bdr-bottom w-100" method="get" action="produk.php">
                    <input type="text" name="s" placeholder="Tulis yang kamu fikirkan..">
                    <button class="search-btn" type="submit"><i class="lnr lnr-magnifier"></i>Cari</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas search form end -->

<!-- offcanvas mini cart start -->
{{-- <div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="lnr lnr-cross"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul>

                        <?php
                        $c = mysqli_query($koneksi, "SELECT * from cart c left join produk p on c.cart_produk=p.produk_id left join galeri g on p.produk_galeri=g.galeri_produk where g.galeri_status='Aktif' and  c.cart_customer='$_SESSION[customer_id]'");
                        $no = 1;
                        $total_harga = 0;
                        while ($cart = mysqli_fetch_assoc($c)) {
                        ?>

                        <li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="product-details.php">
                                    <img src="gambar/produk/<?= $cart['galeri_nama'] ?>" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.php"><?= $cart['produk_nama'] ?></a>
                                </h3>
                                <p>
                                    <span class="cart-quantity"><?= $cart['cart_jumlah'] ?>
                                        <strong>&times;</strong></span>
                                    <span class="cart-price"><?= rupiah($cart['produk_harga']) ?></span>
                                </p>
                                <?php
                                    $total_harga = $total_harga + ($cart['produk_harga'] * $cart['cart_jumlah']);
                                    $cart_atribut = mysqli_query($koneksi, "SELECT * FROM cart_atribut ca left join atribut a on ca.ca_atribut=a.atribut_id left join varian v on a.atribut_varian=v.varian_id where ca.ca_cart='$cart[cart_id]'");
                                    while ($tcart_atribut = mysqli_fetch_assoc($cart_atribut)) {
                                    ?>

                                <p>
                                    <span class="cart-quantity"><?= $tcart_atribut['atribut_nama'] ?>
                                        <sup>(<?= $tcart_atribut['varian_nama'] ?>)</sup></span>
                                </p>
                                <p>
                                    <span class="cart-quantity"><?= $cart['cart_jumlah'] ?>
                                        <strong>&times;</strong></span>
                                    <span class="cart-price"><?= rupiah($tcart_atribut['harga_tambahan']) ?></span>
                                </p>
                                <?php

                                        $total_harga = $total_harga + ($tcart_atribut['harga_tambahan'] * $cart['cart_jumlah']);
                                    } ?>
                            </div>
                            <a class="minicart-remove" href="cart_hapus.php?id=<?= $cart['cart_id'] ?>"><i
                                    class="lnr lnr-cross"></i></a>
                        </li>
                        <?php
                            $no++;
                        } ?>
                    </ul>
                </div>

                <div class="minicart-pricing-box">
                    <ul>
                        <li class="total">
                            <span>total</span>
                            <span><strong><?= rupiah($total_harga) ?></strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="cart.php"><i class="fa fa-shopping-cart"></i> Lihat Keranjang</a>
                    <a href="checkout.php"><i class="fa fa-share"></i> checkout</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- offcanvas mini cart end -->
