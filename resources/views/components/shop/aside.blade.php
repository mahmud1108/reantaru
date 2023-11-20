<aside class="off-canvas-wrapper">
    <div class="off-canvas-overlay"></div>
    <div class="off-canvas-inner-content">
        <div class="btn-close-off-canvas">
            <i class="lnr lnr-cross"></i>
        </div>

        <div class="off-canvas-inner">
            <!-- search box start -->
            <div class="search-box-offcanvas">
                <form method="get" action="{{ route('search') }}">
                    <input type="text" name="query" placeholder="Tulis yang kamu fikirkan..">
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
                                @foreach ($kategoris as $kategori)
                                    <li><a
                                            href={{ route('satu-kategori', ['slug' => $kategori->kategori_nama]) }}>{{ $kategori->kategori_nama }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="produk.php">Produk</a></li>
                        <li><a href="tentang-kami.php">Tentang Kami</a></li>
                        <li class="mega-title menu-item-has-children"><a href="#">Akun</a>
                            <ul class="dropdown">
                                @if (auth()->guard('customer')->user())
                                    <li><a href="{{ route('my-acc') }}">my account</a></li>
                                    <li><a href="{{ route('logout') }}">Logout</a></li>
                                @else
                                    <li><a href="{{ route('login_register_customer') }}">login</a></li>
                                    <li><a href="{{ route('login_register_customer') }}">register</a></li>
                                @endif
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
