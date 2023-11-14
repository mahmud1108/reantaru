@extends('layout.shop-layout.main')

@section('shop-content')
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <h1>Tentang Kami</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('shop-index') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- blog main wrapper start -->
    <div class="blog-main-wrapper section-space pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2">
                    <div class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h4 class="title">search</h4>
                            <div class="sidebar-serch-form">
                                <form method="get" action="produk.php">
                                    <input type="text" class="search-field" name="s"
                                        placeholder="Tulis yang kamu fikirkan..">
                                    <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div> <!-- single sidebar end -->
                    </div>
                </div>
                <div class="col-lg-9 order-1">
                    <!-- blog single item start -->
                    <div class="blog-post-item blog-grid">
                        <div class="post-info-wrapper">
                            <div class="entry-header">
                                <h2 class="entry-title">Rentaru Digital Printing</h2>
                                <div class="post-meta">
                                    <div class="post-author">
                                        Dibuat oleh: <a href="#">Admin</a>
                                    </div>
                                </div>
                            </div>
                            <div class="entry-summary">
                                <p> Kaliwiro Wonosobo adalah sebuah kota kecil di daerah Wonosobo, Jawa Tengah, Indonesia.
                                    Usaha percetakan di Kaliwiro Wonosobo dapat berpotensi menghasilkan laba yang baik
                                    karena kota ini memiliki banyak potensi pasar seperti usaha kecil menengah,
                                    pemerintahan, dan masyarakat umum.</p>
                                <blockquote>
                                    <p><b>Rentaru Digital Printing</b> dapat menawarkan berbagai jenis layanan cetak seperti
                                        cetak brosur, kartu nama, undangan, buku, dan banyak lagi. Dalam rangka meningkatkan
                                        daya saing, percetakan di Kaliwiro Wonosobo dapat mengadopsi teknologi terbaru dan
                                        terus berinovasi untuk menghadapi persaingan di pasar yang semakin ketat.</p>
                                </blockquote>
                                <p>Dengan sejarah percetakan di Kaliwiro Wonosobo mungkin dimulai pada zaman dahulu ketika
                                    orang masih menggunakan teknologi cetak manual seperti stensil dan offset. Namun, dengan
                                    berkembangnya teknologi, <b>Rentaru Digital Printing</b> menjadi solusi dengan
                                    penggunaan mesin cetak digital dan mesin cetak offset yang lebih canggih dan efisien.
                                </p>

                                <div class="blog-share-link">
                                    <h5>share :</h5>
                                    <div class="blog-social-icon">
                                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
