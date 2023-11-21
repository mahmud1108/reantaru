@extends('layout.shop-layout.main')

@section('shop-content')
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <h1>Checkout</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('shop-index') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shop-main-wrapper section-space pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        Detail Pesanan
                        <!-- <span class="badge badge-secondary badge-pill">3</span> -->
                    </h4>
                    <form method="post" action="checkout_act.php" class="needs-validation" novalidate>

                        <ul class="list-group mb-3">
                            @for ($i = 0; $i < count($data_carts); $i++)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ $data_carts[$i]['produk_nama'] }}</h6>
                                        <small class="text-muted">{{ $data_carts[$i]['produk_harga'] }} x
                                            {{ $data_carts[$i]['cart_jumlah'] }}</small>
                                    </div>
                                    <span class="text-muted">{{ $data_carts[$i]['jml_harga'] }}</span>
                                </li>
                                @for ($j = 0; $j < count($data_carts[$i]['atribut']); $j++)
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div class="text-success">
                                            <h6 class="my-0" style="font-size: 12px;">
                                                {{ $data_carts[$i]['atribut'][$j]['atribut_nama'] }}
                                                <sup>({{ $data_carts[$i]['atribut'][$j]['varian_nama'] }})</sup>
                                            </h6>
                                            <small class="text-muted">{{ $data_carts[$i]['atribut'][$j]['harga_tambahan'] }}
                                                x
                                                {{ $data_carts[$i]['cart_jumlah'] }}</small>
                                        </div>
                                        <span
                                            class="text-success">{{ $data_carts[$i]['atribut'][$j]['jml_harga_tambahan'] }}</span>
                                    </li>
                                @endfor
                            @endfor

                            <input type="hidden" name="looping" value="{{ $i }}">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total</span>
                                <strong>Rp. {{ number_format($total_harga, 0, ',', '.') }}</strong>
                                <input type="hidden" name="total_harga" value="{{ $total_harga }}">
                            </li>
                        </ul>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3">Alamat </h4>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Nama Penerima</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Penerima..."
                                value="{{ auth()->guard('customer')->user()->customer_nama }}" required>
                            <div class="invalid-feedback">
                                Nama penerima
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>E-Mail</label>
                        <input type="email" class="form-control" placeholder="E-Mail penerima" name="email"
                            value="{{ auth()->guard('customer')->user()->email }}" required>
                        <div class="invalid-feedback">
                            E-Mail penerima
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>No Hp penerima</label>
                        <input type="text" class="form-control" placeholder="No Hp penerima" name="no_hp"
                            value="{{ auth()->guard('customer')->user()->customer_hp }}" required>
                        <div class="invalid-feedback">
                            No Hp penerima
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="country">Provinsi Tujuan</label>
                            <select class="w-100" id="provinsi" name='provinsi' required>
                                <option>Pilih Provinsi Tujuan</option>
                            </select>
                        </div>
                        <div class="invalid-feedback">
                            Mohon isi Provinsi
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Kabupaten</label>
                            <select id="kabupaten" name="kabupaten" class="w-100" required></select>
                        </div>
                        <div class="invalid-feedback">
                            Mohon isi Kabupaten
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="5" placeholder="Alamat lengkap penerima..."
                            required></textarea>
                        <div class="invalid-feedback">
                            Alamat penerima
                        </div>
                    </div>

                    <hr class="mb-4">
                    <input name="kurir" id="kurir" value="" required="required" type="hidden">
                    <input name="ongkir2" id="ongkir2" value="" required="required" type="hidden">
                    <input name="service" id="service" value="" required="required" type="hidden">

                    <input name="provinsi2" id="provinsi2" value="" required="required" type="hidden">
                    <input name="kabupaten2" id="kabupaten2" value="" required="required" type="hidden">

                    <input name="berat" id="berat2" value="1" type="hidden">

                    <input type="hidden" name="total_bayar" id="total_bayar" value="1">
                    <div id="ongkir"></div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">Yakin data sudah diisi dengan benar?
                        </label>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" id="submit"
                        style="display: none;">Lanjut
                        Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
