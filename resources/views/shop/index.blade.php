@extends('layout.shop-layout.main')

@section('shop-content')
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            <div class="hero-single-slide ">
                <div class="hero-slider-item_3 bg-img" data-bg="assets/img/b1.jpeg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hero-slider-content slide-1">
                                    <span>Kreasimu kami cetak menjadi kenyataan!</span>
                                    <h1>Desain Kreatif, </h1>
                                    <h2>& Cetak Berkualitas.</h2>
                                    <a href="produk.php" class="btn-hero">Pesan Sekarang!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item end -->

            <!-- single slider item start -->
            <div class="hero-single-slide">
                <div class="hero-slider-item_3 bg-img" data-bg="assets/img/b2.jpeg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hero-slider-content slide-2">
                                    <span>Cetak Produkmu dengan Kualitas dan Prestise.</span>
                                    <h1>Teknologi Modern </h1>
                                    <h2>untuk Hidup yang Lebih Baik.</h2>
                                    <a href="kategori.php" class="btn-hero">Lihat Sekarang!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->
            <!-- single slider item start -->
            <div class="hero-single-slide">
                <div class="hero-slider-item_3 bg-img" data-bg="assets/img/b6.jpeg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hero-slider-content slide-2">
                                    <span>Teknologi Modern untuk Hidup yang Lebih Baik.</span>
                                    <h1>Pesan Sekarang, </h1>
                                    <h2>Isi Keranjangmu!</h2>
                                    <a href="cart.php" class="btn-hero">Keranjangku</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->
        </div>
    </section>

    {{-- KATEGORI START --}}
    <section class="our-product section-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>Trending Kategori</h2>
                        <p>Temukan berbagai kategori produk yang kami miliki dan sesuai dengan keubutuhan anda.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-carousel--4 slick-row-15 slick-sm-row-10 slick-arrow-style">
                        @foreach ($kategoris as $kategori)
                            <!-- product single item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="">
                                        <img class="pri-img" src="{{ asset($kategori->kategori_gambar) }}" alt="product">
                                        <img class="sec-img" src="{{ asset($kategori->kategori_gambar) }}" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>{{ count($kategori->produk) }} PRODUK</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href=""><span title="Lihat Kategori"><i
                                                    class="lnr lnr-magnifier"></i></span></a>
                                    </div>
                                </figure>
                                <div class="product-caption">
                                    <p class="product-name">
                                        <a href="">{{ $kategori->kategori_nama }}</a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- KATEGORI END --}}

    <section class="our-product section-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>Semua Produk</h2>
                        <p>Ini adalah semua produk kami yang dapat anda pilih sesuai kebutuhan anda</p>
                    </div>
                </div>
            </div>
            <div class="row mtn-40">
                @for ($i = 0; $i < count($data_produk); $i++)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-item mt-40">
                            <figure class="product-thumb">
                                <a href="detail_produk.php?slug=produk_slug">
                                    <div class="wadah-gambar"
                                        style="width: 270px;height: 270px;display: flex;justify-content: center;align-items: center;overflow: hidden;">
                                        <img class="pri-img" style="max-width: 100%;max-height: 100%;object-fit: contain;"
                                            src="{{ $data_produk[$i]['galeri'][0]['galeri_file'] }}" alt="product">
                                        <img class="sec-img" style="max-width: 100%;max-height: 100%;object-fit: contain;"
                                            src="{{ $data_produk[$i]['galeri'][0]['galeri_file'] }}" alt="product">
                                    </div>
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>{{ $data_produk[$i]['produk_nama'] }}</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="#" data-toggle="modal"
                                        data-target="#quick_view{{ $data_produk[$i]['produk_slug'] }}"><span
                                            data-toggle="tooltip" data-placement="left" title="Lihat"><i
                                                class="lnr lnr-magnifier"></i></span></a>
                                    <a href="cart_tambah.php" data-toggle="tooltip" data-placement="left"
                                        title="Masukkan ke Keranjang"><i class="lnr lnr-cart"></i></a>
                                </div>
                            </figure>
                            <div class="product-caption">
                                <p class="product-name">
                                    <a
                                        href="detail_produk.php?slug={{ $data_produk[$i]['produk_slug'] }}">{{ $data_produk[$i]['produk_nama'] }}</a>
                                </p>
                                <div class="price-box">
                                    <span class="price-regular">Rp.
                                        {{ number_format($data_produk[$i]['produk_harga'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal" id="quick_view{{ $data_produk[$i]['produk_slug'] }}">
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
                                                <div class="product-large-slider">
                                                    <?php
                                                    $galeri = mysqli_query($koneksi, "SELECT * FROM galeri g where g.galeri_produk='$tdaftar_pro[produk_galeri]' ORDER BY galeri_status ASC");
                                                    while ($dgaleri = mysqli_fetch_assoc($galeri)) {
                                                        echo "
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class='pro-large-img img-zoom'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <img src='gambar/produk/$dgaleri[galeri_nama]' alt='product-details' />
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>";
                                                    } ?>
                                                </div>
                                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                                    <?php
                                                    $galeri = mysqli_query($koneksi, "SELECT * FROM galeri g where g.galeri_produk='$tdaftar_pro[produk_galeri]' ORDER BY galeri_status ASC");
                                                    while ($dgaleri = mysqli_fetch_assoc($galeri)) {
                                                        echo "
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class='pro-nav-thumb'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <img src='gambar/produk/$dgaleri[galeri_nama]' alt='product-details' />
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>";
                                                    } ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-7">
                                                <div class="product-details-des quick-details">
                                                    <h3 class="product-name"><?= $tdaftar_pro['produk_nama'] ?></h3>
                                                    <div class="price-box">
                                                        <span
                                                            class="price-regular"><?= rupiah($tdaftar_pro['produk_harga']) ?></span>
                                                    </div>
                                                    <br>
                                                    <div class="availability">
                                                        <i class="fa fa-check-circle"></i>
                                                        <span><?= $tdaftar_pro['kategori_nama'] ?></span>
                                                    </div>
                                                    <p class="pro-desc"><?= $tdaftar_pro['produk_keterangan'] ?></p>
                                                    <div class="quantity-cart-box d-flex align-items-center">
                                                        <div class="action_link">
                                                            <a class="btn btn-cart2"
                                                                href="detail_produk.php?slug=<?= $tdaftar_pro['produk_slug'] ?>">Beli
                                                                Produk</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- product details inner end -->
                                </div>
                            </div>
                        </div>
                    </div> --}}
                @endfor
                <div class="col-12">
                    <div class="view-more-btn">
                        <a class="btn-hero btn-load-more" href="produk.php">Lihat semua produk</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="top-sellers">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>Produk yang mungkin anda sukai</h2>
                        <p>Beberapa produk ini mungkin anda menyukainya.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    @for ($i = 0; $i < count($data_produk); $i++)
                        <div class="product-carousel--4 slick-row-15 slick-sm-row-10 slick-arrow-style">
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="detail_produk.php?slug=produk_slug">
                                        <div class="wadah-gambar"
                                            style="width: 270px;height: 270px;display: flex;justify-content: center;align-items: center;overflow: hidden;">
                                            <img class="pri-img"
                                                style="max-width: 100%;max-height: 100%;object-fit: contain;"
                                                src="{{ $data_produk[$i]['galeri'][0]['galeri_file'] }}" alt="product">
                                            <img class="sec-img"
                                                style="max-width: 100%;max-height: 100%;object-fit: contain;"
                                                src="{{ $data_produk[$i]['galeri'][0]['galeri_file'] }}" alt="product">
                                        </div>
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>{{ $data_produk[$i]['produk_nama'] }}</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="#" data-toggle="modal"
                                            data-target="#quick_view{{ $data_produk[$i]['produk_slug'] }}"><span
                                                data-toggle="tooltip" data-placement="left" title="Lihat"><i
                                                    class="lnr lnr-magnifier"></i></span></a>
                                        <a href="cart_tambah.php" data-toggle="tooltip" data-placement="left"
                                            title="Masukkan ke Keranjang"><i class="lnr lnr-cart"></i></a>
                                    </div>
                                </figure>
                                <div class="product-caption">
                                    <p class="product-name">
                                        <a
                                            href="detail_produk.php?slug={{ $data_produk[$i]['produk_slug'] }}">{{ $data_produk[$i]['produk_nama'] }}</a>
                                    </p>
                                    <div class="price-box">
                                        <span class="price-regular">Rp.
                                            {{ number_format($data_produk[$i]['produk_harga'], 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor

                </div>
            </div>
        </div>
    </section>
@endsection
