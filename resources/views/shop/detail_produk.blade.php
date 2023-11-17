@extends('layout.shop-layout.main')

@section('shop-content')
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <h1>Detail Produk {{ $produk->produk_nama }}</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('shop-index') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Detail Produk
                                    {{ $produk->produk_nama }}</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('cart.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="shop-main-wrapper section-space">
            <div class="container">
                <div class="row">
                    <!-- product details wrapper start -->
                    <div class="col-lg-12 order-1 order-lg-2">
                        <!-- product details inner end -->
                        <div class="product-details-inner">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="product-large-slider">
                                        <div class='pro-large-img img-zoom'>
                                            <img src='{{ asset($data_produk[0]['galeri'][0]['galeri_file']) }}'
                                                alt='product-details' />
                                        </div>
                                    </div>
                                    <div class="pro-nav slick-row-10 slick-arrow-style">
                                        <div class='pro-nav-thumb'>
                                            <img src='{{ asset($data_produk[0]['galeri'][0]['galeri_file']) }}'
                                                alt='product-details' />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="product-details-des">
                                        <h3 class="product-name">{{ $data_produk[0]['produk_nama'] }}</h3>
                                        <div class="price-box">
                                            <span class="price-regular">Rp.
                                                {{ number_format($data_produk[0]['produk_harga'], 0, ',', '.') }}</span>
                                            <input type="hidden" name="produk_id"
                                                value="{{ $data_produk[0]['produk_id'] }}">
                                            <input type="hidden" id="harga_satuan"
                                                value="{{ $data_produk[0]['produk_harga'] }}">
                                        </div>
                                        <br>
                                        <div class="availability">
                                            <i class="fa fa-check-circle"></i>
                                            <span>Kategori {{ $data_produk[0]['produk_kategori'] }}</span>
                                        </div>
                                        <p class="pro-desc">{!! $data_produk[0]['produk_keterangan'] !!}</p>
                                        <br>
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h5>qty:</h5>
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" name="jumlah" min=1 value=1 id="satuan">
                                                </div>
                                            </div>
                                        </div>

                                        @for ($i = 0; $i < count($data_produk[0]['varian']); $i++)
                                            <div class="pro-size">
                                                <h5>{{ $data_produk[0]['varian'][$i]['varian_nama'] }} :</h5>
                                                <select name="varian{{ $i }}" id="varian{{ $i }}"
                                                    class="nice-select">
                                                    <option value="">Pilih
                                                        {{ $data_produk[0]['varian'][$i]['varian_nama'] }}</option>

                                                    @for ($j = 0; $j < count($data_produk[0]['varian'][$i]['atribut']); $j++)
                                                        <option
                                                            value="{{ $data_produk[0]['varian'][$i]['atribut'][$j]['atribut_id'] }}"
                                                            data-atribut_nama="{{ $data_produk[0]['varian'][$i]['atribut'][$j]['atribut_nama'] }}"
                                                            data-harga_tambahan="{{ $data_produk[0]['varian'][$i]['atribut'][$j]['harga_tambahan'] }}"
                                                            data-nama_varian="{{ $data_produk[0]['varian'][$i]['varian_nama'] }}">
                                                            {{ $data_produk[0]['varian'][$i]['atribut'][$j]['atribut_nama'] }}
                                                        </option>
                                                    @endfor

                                                </select>
                                            </div>
                                        @endfor

                                        <input type="hidden" id="no_var" value="{{ $i }}" name="no_var">
                                        <div class="single-input-item">
                                            <label for="foto">Upload File <small style="color: grey;">(Jpg, Jpeg,
                                                    Pdf)</small> </label>
                                            <input type="file" name="foto" required />
                                        </div>
                                        <div class="single-input-item">
                                            <label for="no_hp">Keterangan Order</label>
                                            <textarea name="keterangan" id="" cols="30" rows="5" placeholder="Keterangan Order"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-7 ml-auto">
                                <!-- Cart Calculation Area -->
                                <div class="cart-calculator-wrapper">
                                    <div class="cart-calculate-items">
                                        <h3>Keranjang Total</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <td>{{ $data_produk[0]['produk_nama'] }}</td>
                                                    <td>
                                                        <div id="sup_harga_satuan">
                                                    </td>
                                                    <td>
                                                        <div id="sup_jumlah_satuan">
                                                    </td>
                                                    <td>
                                                        <div id="sup_total_satuan">
                                                    </td>
                                                </tr>

                                                @for ($i = 0; $i < count($data_produk[0]['varian']); $i++)
                                                    @for ($j = 0; $j < count($data_produk[0]['varian'][$i]['atribut']); $j++)
                                                        <tr id="sup_tr{{ $j }}" style="display: none;">
                                                            <td>
                                                                <div id="sup_nama_atribut{{ $j }}"></div>
                                                            </td>
                                                            <td>
                                                                <div id="asli_tambahan{{ $j }}"></div>
                                                            </td>
                                                            <td>
                                                                <div id="sup_jumlah{{ $j }}"></div>
                                                            </td>
                                                            <td>
                                                                <div id="sup_total{{ $j }}"></div>
                                                            </td>
                                                        </tr>
                                                    @endfor
                                                @endfor
                                                <tr class="total">
                                                    <td>Total</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="total-amount">
                                                        <div id="total-harga"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    @if (!auth()->guard('customer')->user())
                                        <a href="{{ route('login_register_customer') }}"
                                            class="btn btn__bg d-block">Login</a>
                                    @else
                                        <input type="submit" id="save" style="width: 100%;"
                                            class="btn btn__bg d-block" value="Masukkan ke Keranjang">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('javascript')
    <script>
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);

            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + ribuan;
        }
    </script>

    <script>
        // Set interval untuk memantau perubahan
        setInterval(function() {
            var no_var = document.getElementById('no_var').value;
            var satuan = parseInt(document.getElementById('satuan').value);
            var harga_satuan = parseInt(document.getElementById('harga_satuan').value);

            if (satuan < 1) {
                document.getElementById('satuan').value = "1"
            }

            document.getElementById('sup_harga_satuan').innerHTML = formatRupiah(harga_satuan)
            document.getElementById('sup_jumlah_satuan').innerHTML = satuan;
            var total = satuan * harga_satuan;
            document.getElementById('sup_total_satuan').innerHTML = formatRupiah(total)

            var totalHarga = 0;

            // Loop through each select element
            for (let i = 0; i <= no_var; i++) {
                // Get the select element and the selected option element
                var selectElem = document.getElementById('varian' + i);
                var selectedOption = selectElem.options[selectElem.selectedIndex];
                var atributNama = selectedOption.dataset.atribut_nama;
                var hargaTambahan = selectedOption.dataset.harga_tambahan;
                var nama_varian = selectedOption.dataset.nama_varian;
                var value = selectedOption.value;
                if (atributNama !== undefined) {
                    document.getElementById('sup_tr' + i).style.display = 'table-row';
                    document.getElementById('sup_nama_atribut' + i).innerHTML = atributNama + " <sup>(" +
                        nama_varian + ")</sup>";
                    document.getElementById('asli_tambahan' + i).innerHTML = formatRupiah(parseInt(hargaTambahan))
                    document.getElementById('sup_jumlah' + i).innerHTML = satuan;
                    var sup_harga = satuan * hargaTambahan;
                    document.getElementById('sup_total' + i).innerHTML = formatRupiah(sup_harga)
                    totalHarga += sup_harga;

                } else {
                    document.getElementById('sup_tr' + i).style.display = 'none';
                }
            }
            var total_harga = total + totalHarga;
            console.log(total_harga);
            document.getElementById('total-harga').innerHTML = formatRupiah(total_harga)
        });
    </script>
@endsection
