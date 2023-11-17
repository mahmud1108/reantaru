@extends('layout.shop-layout.main')

@section('shop-content')
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap" style="padding: 50px 0px;">
                        <nav aria-label="breadcrumb">
                            <h1>Profil</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profil</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-account-wrapper section-space pb-0" style="padding-top: 30px;">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#dashboard" class="active" data-toggle="tab"><i
                                                class="fa fa-dashboard"></i>
                                            Dashboard</a>
                                        <a onclick="window.location.hash='#profil';" href="#profil" data-toggle="tab"><i
                                                class="fa fa-user"></i>Profil Akun</a>
                                        <a onclick="window.location.hash='#ganti_pass';" href="#ganti_pass"
                                            data-toggle="tab"><i class="fa fa-key"></i>Ganti password</a>
                                        <a href="#keranjang" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                                            Keranjang</a>
                                        <a href="#transaksi" data-toggle="tab"><i class="fa fa-dollar"></i>
                                            Transaksi</a>
                                        <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">

                                    {{-- <div class="alert alert-success alert-dismissible fade show" id="multi_mail"
                                        role="alert">
                                        <strong>asdfasdf</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> --}}
                                    @if (session('text'))
                                        <div class="alert alert-{{ session('type') }} alert-dismissible fade show"
                                            id="multi_mail" role="alert">
                                            <strong>{{ session('text') }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger alert-dismissible fade show" id="multi_mail"
                                                role="alert">
                                                <strong>{{ $error }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="welcome">
                                                    <p>Hello,
                                                        <strong>{{ auth()->guard('customer')->user()->customer_nama }}</strong>
                                                    </p>
                                                </div>
                                                <p class="mb-0">Dari dashboard akun Anda, Anda bisa lebih dari sekadar
                                                    memeriksa pesanan terbaru dan mengelola alamat pengiriman. Anda bisa
                                                    melacak riwayat transaksi dengan mudah, memilih opsi pembayaran yang
                                                    berbeda, dan bahkan mendapatkan penawaran eksklusif hanya untuk Anda.
                                                    Selain itu, Anda juga bisa mengubah informasi pribadi Anda, seperti
                                                    alamat email, nomor telepon, atau bahkan foto profil. </p>
                                                <p class="mb-0">Dengan akses ke semua fitur ini, Anda dapat mengelola
                                                    akun Anda dengan mudah dan membuat pengalaman belanja online Anda
                                                    menjadi lebih baik.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        {{-- <div class="tab-pane fade" id="keranjang" role="tabpanel">
                                            <div class="cart-main-wrapper section-space pb-0 pt-0">
                                                <div class="container">
                                                    <div class="section-bg-color">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <!-- Cart Table Area -->
                                                                <div class="cart-table table-responsive">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th class="pro-thumbnail">Thumbnail</th>
                                                                                <th class="pro-title">Produk</th>
                                                                                <th class="pro-price">Harga</th>
                                                                                <th class="pro-quantity">Jumlah Produk</th>
                                                                                <th class="pro-subtotal">Keterangan</th>
                                                                                <th class="pro-remove">Aksi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                          $c = mysqli_query($koneksi, "SELECT * from cart c left join produk p on c.cart_produk=p.produk_id left join galeri g on p.produk_galeri=g.galeri_produk where g.galeri_status='Aktif' and  c.cart_customer='$_SESSION[customer_id]'");
                                          $no = 1;
                                          $total_harga = 0;
                                          while ($cart = mysqli_fetch_assoc($c)) {
                                          ?>
                                                                            <tr>
                                                                                <td><?= $no ?></td>
                                                                                <td class="pro-thumbnail"><a
                                                                                        href="#"><img
                                                                                            class="img-fluid"
                                                                                            src="gambar/produk/<?= $cart['galeri_nama'] ?>"
                                                                                            alt="Product" /></a></td>
                                                                                <td class="pro-title"><a
                                                                                        href="#"><?= $cart['produk_nama'] ?></a>
                                                                                </td>
                                                                                <td class="pro-price">
                                                                                    <span><?= rupiah($cart['produk_harga']) ?></span>
                                                                                </td>
                                                                                <td class="pro-quantity">
                                                                                    <?= $cart['cart_jumlah'] ?>
                                                                                </td>
                                                                                <td class="pro-subtotal">
                                                                                    <span><?= rupiah($cart['produk_harga'] * $cart['cart_jumlah']) ?></span>
                                                                                </td>
                                                                                <td class="pro-remove"><a
                                                                                        href="cart_edit.php?id=<?= $cart['cart_id'] ?>"><i
                                                                                            class="fa fa-pencil"></i></a>
                                                                                    &nbsp;<a href="#"
                                                                                        data-toggle="modal"
                                                                                        data-target="#deleteCart<?= $cart['cart_id'] ?>"><i
                                                                                            class="fa fa-trash-o"></i></a>
                                                                                </td>
                                                                            </tr>

                                                                            <!-- Elemen untuk dialog modal -->
                                                                            <div class="modal fade"
                                                                                id="deleteCart<?= $cart['cart_id'] ?>">
                                                                                <div class="modal-dialog modal-md">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal">&times;</button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="modal-body">
                                                                                                Apakah Anda yakin ingin
                                                                                                menghapus data ini?
                                                                                                <b><?= $cart['produk_nama'] ?></b>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <form action=""
                                                                                                    method="post">
                                                                                                    <input type="hidden"
                                                                                                        name="hapus_cart"
                                                                                                        value="<?= $cart['cart_id'] ?>">
                                                                                                    <button type="submit"
                                                                                                        class="btn btn__bg d-block">Hapus</button>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <?php
                                            $total_harga = $total_harga + ($cart['produk_harga'] * $cart['cart_jumlah']);
                                            $cart_atribut = mysqli_query($koneksi, "SELECT * FROM cart_atribut ca left join atribut a on ca.ca_atribut=a.atribut_id left join varian v on a.atribut_varian=v.varian_id where ca.ca_cart='$cart[cart_id]'");
                                            while ($tcart_atribut = mysqli_fetch_assoc($cart_atribut)) {
                                            ?>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td class="pro-title"><a
                                                                                        href="#"><?= $tcart_atribut['atribut_nama'] ?>
                                                                                        <sup>(<?= $tcart_atribut['varian_nama'] ?>)</sup></a>
                                                                                </td>
                                                                                <td class="pro-price">
                                                                                    <span><?= rupiah($tcart_atribut['harga_tambahan']) ?></span>
                                                                                </td>
                                                                                <td class="pro-quantity">
                                                                                    <?= $cart['cart_jumlah'] ?>
                                                                                </td>
                                                                                <td class="pro-price">
                                                                                    <span><?= rupiah($tcart_atribut['harga_tambahan'] * $cart['cart_jumlah']) ?></span>
                                                                                </td>
                                                                                <td class="pro-remove"><a href="#"
                                                                                        data-toggle="modal"
                                                                                        data-target="#deleteAtribut<?= $tcart_atribut['ca_id'] ?>"><i
                                                                                            class="fa fa-trash-o"></i></a>
                                                                                </td>
                                                                            </tr>

                                                                            <!-- Elemen untuk dialog modal -->
                                                                            <div class="modal fade"
                                                                                id="deleteAtribut<?= $tcart_atribut['ca_id'] ?>">
                                                                                <div class="modal-dialog modal-md">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal">&times;</button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="modal-body">
                                                                                                Apakah Anda yakin ingin
                                                                                                menghapus data ini?
                                                                                                <b><?= $tcart_atribut['atribut_nama'] ?></b>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <form action=""
                                                                                                    method="post">
                                                                                                    <input type="hidden"
                                                                                                        name="hapus_atribut"
                                                                                                        value="<?= $tcart_atribut['ca_id'] ?>">
                                                                                                    <button type="submit"
                                                                                                        class="btn btn__bg d-block">Hapus</button>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
    
                                              $total_harga = $total_harga + ($tcart_atribut['harga_tambahan'] * $cart['cart_jumlah']);
                                            }
                                            $no++;
                                          } ?>

                                                                            <tr class="total">
                                                                                <td colspan="4"></td>
                                                                                <td style="font-size: 15px;">
                                                                                    Total
                                                                                </td>
                                                                                <td class="total-amount">
                                                                                    <?= rupiah($total_harga) ?></td>
                                                                                <td></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                $jml = mysqli_num_rows(mysqli_query($koneksi, "SELECT * from cart where cart_customer='$_SESSION[customer_id]'"));
                                if ($jml > 0) {
                                ?>
                                                        <div class="row">
                                                            <div class="col-lg-5 ml-auto">
                                                                <!-- Cart Calculation Area -->
                                                                <div class="cart-calculator-wrapper">
                                                                    <a href="checkout.php"
                                                                        class="btn btn__bg d-block">Proses Checkout</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php } else { ?>
                                                        <div class="row">
                                                            <div class="col-lg-5 ml-auto">
                                                                <!-- Cart Calculation Area -->
                                                                <div class="cart-calculator-wrapper">
                                                                    <a href="produk.php"
                                                                        class="btn btn__bg d-block">Tambah Produk</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="tab-pane fade" id="transaksi" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Daftar Transaksi</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Produk</th>
                                                                <th>Nama Penerima</th>
                                                                <th>Status Pembayaran</th>
                                                                <th>Status Pengiriman</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                  $t = mysqli_query($koneksi, "SELECT * FROM transaksi t left join customer c on t.transaksi_customer=c.customer_id where customer_id='$_SESSION[customer_id]' order by t.transaksi_id desc");
                                  // left join transaksi_produk tp on t.transaksi_id=tp.tp_transaksi left join produk p on tp.tp_produk=p.produk_id
                                  $no = 1;
                                  while ($transaksi = mysqli_fetch_assoc($t)) {
                                  ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td>
                                                                    <?php $nama = mysqli_query($koneksi, "SELECT * FROM transaksi_produk tp left join produk p on tp.tp_produk=p.produk_id where tp.tp_transaksi='$transaksi[transaksi_id]'");
                                        while ($nama_produk = mysqli_fetch_assoc($nama)) {
                                        ?>
                                                                    <?= $nama_produk['produk_nama'] ?><br>
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?= $transaksi['transaksi_nama'] ?></td>
                                                                <td><?= $transaksi['transaksi_status'] ?></td>
                                                                <td><?= $transaksi['transaksi_status_pengiriman'] ?></td>
                                                                <td>
                                                                    <a
                                                                        href="invoice.php?transaksi=<?= $transaksi['transaksi_id'] ?>"><button
                                                                            class="btn btn__bg">Detail Pesanan</button></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                    $no++;
                                  }
                                  ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="profil" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Detail Akun</h3>
                                                <div class="account-details-form">
                                                    <form action="{{ route('profil_update') }}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="single-input-item">
                                                                    <label for="first-name">Nama Lengkap</label>
                                                                    <input type="text" id="first-name" name="nama"
                                                                        placeholder="Nama Lengkap"
                                                                        value="{{ auth()->guard('customer')->user()->customer_nama }}"
                                                                        required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email">Email Addres</label>
                                                            <input type="email" id="email" name="email"
                                                                value="{{ auth()->guard('customer')->user()->email }}"
                                                                placeholder="Email Address" required />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="no_hp">No Handphone</label>
                                                            <input type="text" id="customer_hp" name="customer_hp"
                                                                placeholder="No Handphone"
                                                                value="{{ auth()->guard('customer')->user()->customer_hp }}"
                                                                required />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <button class="btn btn__bg" name="save">SImpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->

                                        <div class="tab-pane fade" id="ganti_pass" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Ganti Password</h3>
                                                <div class="account-details-form">
                                                    <form action="{{ route('password') }}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="single-input-item">
                                                                    <label>Password Baru</label>
                                                                    <input type="password" name="password"
                                                                        placeholder="Password Baru" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label>Konfirmasi Password</label>
                                                            <input type="password" name="password_confirmation"
                                                                placeholder="Konfirmasi Password" />
                                                        </div>

                                                        <div class="single-input-item">
                                                            <button class="btn btn__bg" name="ubah_password">SImpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
