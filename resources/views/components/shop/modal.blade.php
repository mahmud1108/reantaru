<div class="offcanvas-search-wrapper">
    <div class="offcanvas-search-inner">
        <div class="offcanvas-close">
            <i class="lnr lnr-cross"></i>
        </div>
        <div class="container">
            <div class="offcanvas-search-box">
                <form class="d-flex bdr-bottom w-100" method="get" action="{{ route('search') }}">
                    <input type="text" name="query" placeholder="Cari produk..">
                    <button class="search-btn" type="submit"><i class="lnr lnr-magnifier"></i>Cari</button>
                </form>
            </div>
        </div>
    </div>
</div>
