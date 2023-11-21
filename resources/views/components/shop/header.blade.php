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
                                @if (auth()->guard('customer')->user())
                                    <li class="curreny-wrap">
                                        <span><a href="{{ route('logout') }}">Logout</a></span>
                                    </li>
                                @else
                                    <li class="curreny-wrap">
                                        <span><a href="{{ route('login_register_customer') }}">Daftar Akun</a></span>
                                    </li>
                                @endif
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
                                <img src="{{ asset('assets/img/logo/logo2.png') }}" alt="">
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
                                        <li class="{{ request()->is('/') ? 'active' : '' }}"><a
                                                href="{{ route('shop-index') }}">Beranda</a></li>
                                        <li class="{{ request()->is('/kategori') ? 'active' : '' }}">
                                            <a href="{{ route('all_kategori') }}">Kategori <i
                                                    class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                @foreach ($kategoris as $kategori)
                                                    <li>
                                                        <a
                                                            href="{{ route('satu-kategori', ['slug' => $kategori->kategori_nama]) }}">{{ $kategori->kategori_nama }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="{{ request()->is('produk') ? 'active' : '' }}"><a
                                                href="{{ route('produk') }}">Produk</a></li>
                                        <li class="{{ request()->is('tentang') ? 'active' : '' }}"><a
                                                href="{{ route('tentang') }}">Tentang Kami</a></li>
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
                                            @if (auth()->guard('customer')->user())
                                                <li><a href="{{ route('my-acc') }}">my account</a></li>
                                                <li><a href="{{ route('logout') }}">Logout</a></li>
                                            @else
                                                <li><a href="{{ route('login_register_customer') }}">login</a></li>
                                                <li><a href="{{ route('login_register_customer') }}">register</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @if (Route::currentRouteName() != 'checkout')
                                        @if (auth()->guard('customer')->user())
                                            <li>
                                                <a href="#" class="minicart-btn">
                                                    <i class="lnr lnr-cart"></i>
                                                    @if ($jml_cart > 0)
                                                        <div class="notification">{{ $jml_cart }}</div>
                                                    @endif
                                                </a>
                                            </li>
                                        @endif
                                    @endif
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
                                <img src="{{ asset('assets/img/logo/logo2.png') }}" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="mobile-menu-toggler">
                            <div class="mini-cart-wrap">
                                <a href="{{ route('cart.index') }}php">
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

@if (Route::currentRouteName() != 'checkout')
    @if (auth()->guard('customer')->user())
        <div class="offcanvas-minicart-wrapper">
            <div class="minicart-inner">
                <div class="offcanvas-overlay"></div>
                <div class="minicart-inner-content">
                    <div class="minicart-close">
                        <i class="lnr lnr-cross"></i>
                    </div>
                    <div class="minicart-content-box">
                        <div class="minicart-item-wrapper">
                            <ul>
                                @for ($i = 0; $i < count($data_carts_modal); $i++)
                                    <li class="minicart-item">
                                        <div class="minicart-thumb">
                                            <a href="product-details.php">
                                                <img src="{{ asset($data_carts_modal[$i]['galeri'][0]['galeri_file']) }}"
                                                    alt="product">
                                            </a>
                                        </div>
                                        <div class="minicart-content">
                                            <h3 class="product-name">
                                                <a
                                                    href="product-details.php">{{ $data_carts_modal[$i]['produk_nama'] }}</a>
                                            </h3>
                                            <p>
                                                <span class="cart-quantity">{{ $data_carts_modal[$i]['cart_jumlah'] }}
                                                    <strong>&times;</strong></span>
                                                <span class="cart-price">Rp.
                                                    {{ number_format($data_carts_modal[$i]['produk_harga'], 0, ',', '.') }}</span>
                                            </p>
                                            @for ($j = 0; $j < count($data_carts_modal[$i]['cart_atribut']); $j++)
                                                <p>
                                                    <span
                                                        class="cart-quantity">{{ $data_carts_modal[$i]['cart_atribut'][$j]['atribut_nama'] }}
                                                        <sup>({{ $data_carts_modal[$i]['cart_atribut'][$j]['varian_nama'] }})</sup></span>
                                                </p>
                                                <p>
                                                    <span
                                                        class="cart-quantity">{{ $data_carts_modal[$i]['cart_jumlah'] }}
                                                        <strong>&times;</strong></span>
                                                    <span class="cart-price">Rp.
                                                        {{ number_format($data_carts_modal[$i]['cart_atribut'][$j]['harga_tambahan'], 0, ',', '.') }}</span>
                                                </p>
                                            @endfor
                                        </div>
                                        <form action="{{ route('cart.destroy', $data_carts_modal[$i]['cart_id']) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="minicart-remove" title="delete"><i
                                                    class="lnr lnr-cross"></i></button>
                                        </form>
                                    </li>
                                @endfor
                            </ul>
                        </div>

                        <div class="minicart-pricing-box">
                            <ul>
                                <li class="total">
                                    <span>total</span>
                                    <span><strong>Rp.
                                            {{ number_format($total_harga_modal, 0, ',', '.') }}</strong></span>
                                </li>
                            </ul>
                        </div>

                        <div class="minicart-button">
                            <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i> Lihat
                                Keranjang</a>
                            <a href="{{ route('checkout') }}"><i class="fa fa-share"></i> checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
