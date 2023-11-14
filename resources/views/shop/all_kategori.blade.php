@extends('layout.shop-layout.main')

@section('shop-content')
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <h1>Semua Kategori</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('shop-index') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Semua Kategori</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-space pb-0">
        <div class="container">
            <div class="row">
                <!-- sidebar area start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar-wrapper">
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h3 class="sidebar-title">kategori</h3>
                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                    @foreach ($kategoris as $kategori)
                                        <li class="active">
                                            <a href={{ route('satu-kategori', $kategori->kategori_nama) }}>{{ $kategori->kategori_nama }}
                                                <span>{{ count($kategori->produk) }}</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <div class="blog-sidebar">
                            <div class="sidebar-serch-form">
                                <form method="get" action="produk.php">
                                    <input type="text" name="s" class="search-field" placeholder="Cari produk">
                                    <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div> <!-- single sidebar end -->
                    </aside>
                </div>
                <!-- sidebar area end -->

                <!-- shop main wrapper start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view" data-toggle="tooltip"
                                                title="Grid View"><i class="fa fa-th"></i></a>
                                            <a href="" data-target="list-view" data-toggle="tooltip"
                                                title="List View"><i class="fa fa-list"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                    <div class="top-bar-right">
                                        <div class="product-short">
                                            <p>Sort By : </p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">Relevance</option>
                                                <option value="sales">Name (A - Z)</option>
                                                <option value="sales">Name (Z - A)</option>
                                                <option value="rating">Price (Low &gt; High)</option>
                                                <option value="date">Rating (Lowest)</option>
                                                <option value="price-asc">Model (A - Z)</option>
                                                <option value="price-asc">Model (Z - A)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="shop-product-wrap grid-view row mbn-40">
                            @for ($i = 0; $i < count($data_produk); $i++)
                                <div class="col-md-4 col-sm-6">
                                    <!-- product grid start -->
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="">
                                                <div class="wadah-gambar"
                                                    style="width: 270px;height: 270px;display: flex;justify-content: center;align-items: center;overflow: hidden;">
                                                    <img class="pri-img"
                                                        style="max-width: 100%;max-height: 100%;object-fit: contain;"
                                                        src="{{ asset($data_produk[$i]['galeri'][0]['galeri_file']) }}"
                                                        alt="product">
                                                    <img class="sec-img"
                                                        style="max-width: 100%;max-height: 100%;object-fit: contain;"
                                                        src="{{ asset($data_produk[$i]['galeri'][0]['galeri_file']) }}"
                                                        alt="product">
                                                </div>
                                            </a>
                                            <div class="product-badge">
                                                <div class="product-label new">
                                                    <span>{{ $data_produk[$i]['produk_kategori'] }}</span>
                                                </div>
                                            </div>
                                            <div class="button-group">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#quick_view{{ $i }}"><span data-toggle="tooltip"
                                                        data-placement="left" title="Lihat"><i
                                                            class="lnr lnr-magnifier"></i></span></a>
                                                <a href="cart_tambah.php" data-toggle="tooltip" data-placement="left"
                                                    title="Masukkan ke Keranjang"><i class="lnr lnr-cart"></i></a>
                                            </div>
                                        </figure>
                                        <div class="product-caption">
                                            <p class="product-name">
                                                <a
                                                    href="detail_produk.php?slug=asdf">{{ $data_produk[$i]['produk_nama'] }}</a>
                                            </p>
                                            <div class="price-box">
                                                <span class="price-regular">Rp.
                                                    {{ number_format($data_produk[$i]['produk_harga'], 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" id="quick_view{{ $i }}">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- product details inner end -->
                                                    <div class="product-details-inner">
                                                        <div class="row">
                                                            <div class="col-lg-5 col-md-5">
                                                                <div class="product-large-slider">

                                                                    @for ($j = 0; $j < count($data_produk[$i]['galeri']); $j++)
                                                                        <div class="pro-large-img img-zoom">
                                                                            <img src="{{ asset($data_produk[$i]['galeri'][$j]['galeri_file']) }}"
                                                                                alt="product-details" />
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                                                    @for ($j = 0; $j < count($data_produk[$i]['galeri']); $j++)
                                                                        <div class="pro-nav-thumb">
                                                                            <img src="{{ asset($data_produk[$i]['galeri'][$j]['galeri_file']) }}"
                                                                                alt="product-details" />
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7 col-md-7">
                                                                <div class="product-details-des quick-details">
                                                                    <h3 class="product-name" id="produk_nama">
                                                                        {{ $data_produk[$i]['produk_nama'] }} </h3>
                                                                    <div class="price-box">
                                                                        <span class="price-regular" id="produk_harga">Rp.
                                                                            {{ number_format($data_produk[$i]['produk_harga'], 0, ',', '.') }}</span>
                                                                    </div>
                                                                    <div class="availability">
                                                                        <i class="fa fa-check-circle"></i>
                                                                        <span
                                                                            id='produk_kategori'>{{ $data_produk[$i]['produk_kategori'] }}</span>
                                                                    </div>
                                                                    <span class="pro-desk"
                                                                        id="produk_keterangan">{!! $data_produk[$i]['produk_keterangan'] !!}</span>
                                                                    <div
                                                                        class="quantity-cart-box d-flex align-items-center">
                                                                        <div class="action_link">
                                                                            <a class="btn btn-cart2"
                                                                                href="#">Beli</a>
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
                                    <!-- product grid end -->

                                    <!-- product list item end -->
                                    <div class="product-list-item list-view">
                                        @for ($i = 0; $i < count($data_produk); $i++)
                                            <figure class="product-thumb">
                                                <a href="detail_produk.php?slug=">
                                                    <div class="wadah-gambar"
                                                        style="width: 270px;height: 270px;display: flex;justify-content: center;align-items: center;overflow: hidden;">
                                                        <img class="pri-img"
                                                            style="max-width: 100%;max-height: 100%;object-fit: contain;"
                                                            src="{{ $data_produk[$i]['galeri'][0]['galeri_file'] }}"
                                                            alt="product">
                                                        <img class="sec-img"
                                                            style="max-width: 100%;max-height: 100%;object-fit: contain;"
                                                            src="{{ $data_produk[$i]['galeri'][0]['galeri_file'] }}"
                                                            alt="product">
                                                    </div>
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>{{ $data_produk[$i]['produk_nama'] }}</span>
                                                    </div>
                                                </div>
                                            </figure>
                                            <div class="product-content-list">
                                                <h5 class="product-name">
                                                    <a
                                                        href="detail_produk.php?slug=">{{ $data_produk[$i]['produk_nama'] }}</a>
                                                </h5>
                                                <div class="price-box">
                                                    <span class="price-regular">Rp.
                                                        {{ number_format($data_produk[$i]['produk_harga'], 0, ',', '.') }}</span>
                                                </div>
                                                {!! $data_produk[$i]['produk_keterangan'] !!}
                                                <div class="button-group-list">
                                                    <a class="btn-big" href="cart_tambah.php" data-toggle="tooltip"
                                                        title="Masukkan ke Keranjang"><i class="lnr lnr-cart"></i>Masukkan
                                                        ke
                                                        Keranjang</a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#quick_view{{ $i }}"><span
                                                            data-toggle="tooltip" title="Lihat"><i
                                                                class="lnr lnr-magnifier"></i></span></a>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                    <!-- product list item end -->
                                </div>
                            @endfor
                        </div>

                        {{-- <div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                <li><a class="previous" <?php if ($halaman > 1) {
                                    echo "href='?halaman=$previous'";
                                } ?>><i class="lnr lnr-chevron-left"></i></a></li>

                                <?php
                            for ($x = 1; $x <= $total_halaman; $x++) {
                            ?>
                                <li><a href="?halaman=<?php echo $x; ?>"><?php echo $x; ?></a></li>
                                <?php
                            }
                            ?>
                                <li><a class="next" <?php if ($halaman < $total_halaman) {
                                    echo "href='?halaman=$next'";
                                } ?>><i class="lnr lnr-chevron-right"></i></a></li>
                            </ul>
                        </div> --}}

                    </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
@endsection
