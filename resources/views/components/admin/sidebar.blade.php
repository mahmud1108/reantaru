<nav id="sidebar" class="active">
    <div class="sidebar-header">
        <img src="{{ asset('template/assets/img/bootstraper-logo.png') }}" alt="bootraper logo" class="app-logo">
    </div>
    <ul class="list-unstyled components text-secondary">
        <li>
            <a href="{{ route('admin-dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{ route('kategori.index') }}"><i class="fas fa-file-alt"></i> Kategori</a>
        </li>
        <li>
            <a href="{{ route('produk.index') }}"><i class="fas fa-shopping-cart"></i> Produk</a>
        </li>
        <li>
            <a href="{{ route('admin-logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
</nav>
