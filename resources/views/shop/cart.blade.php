@extends('layout.shop-layout.main')

@section('shop-content')
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap" style="padding: 30px;">
                        <nav aria-label="breadcrumb">
                            <h1>cart</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('shop-index') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-space pb-0">
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
                                    @for ($i = 0; $i < count($data_carts); $i++)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="pro-thumbnail"><a href="#"><img class="img-fluid"
                                                        src="{{ asset($data_carts[$i]['produk_thumb'][0]['galeri']) }}"
                                                        alt="Product" /></a>
                                            </td>
                                            <td class="pro-title"><a href="#">{{ $data_carts[$i]['produk_nama'] }}</a>
                                            </td>
                                            <td class="pro-price"><span>{{ $data_carts[$i]['produk_harga'] }}</span></td>
                                            <td class="pro-quantity">
                                                {{ $data_carts[$i]['cart_jumlah'] }}
                                            </td>
                                            <td class="pro-subtotal">
                                                <span>{{ $data_carts[$i]['jml_harga'] }}</span>
                                            </td>
                                            <td class="pro-remove"><a
                                                    href="{{ route('cart.show', $data_carts[$i]['cart_id']) }}"><i
                                                        class="fa fa-pencil" title="edit"></i></a>
                                                &nbsp;<a href="#" data-toggle="modal"
                                                    data-target="#deleteCart{{ $data_carts[$i]['cart_id'] }}"
                                                    title="delete"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>

                                        <!-- Elemen untuk dialog modal -->
                                        <div class="modal fade" id="deleteCart{{ $data_carts[$i]['cart_id'] }}">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus data ini?
                                                            <b>{{ $data_carts[$i]['produk_nama'] }}</b>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form
                                                                action="{{ route('cart.destroy', $data_carts[$i]['cart_id']) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="btn btn__bg d-block">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @for ($j = 0; $j < count($data_carts[$i]['atribut']); $j++)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="pro-title"><a href="#">
                                                        {{ $data_carts[$i]['atribut'][$j]['atribut_nama'] }}
                                                        <sup>({{ $data_carts[$i]['atribut'][$j]['varian_nama'] }})</sup></a>
                                                </td>
                                                <td class="pro-price">
                                                    <span>{{ $data_carts[$i]['atribut'][$j]['harga_tambahan'] }}</span>
                                                </td>
                                                <td class="pro-quantity">
                                                    {{ $data_carts[$i]['cart_jumlah'] }}
                                                </td>
                                                <td class="pro-price">
                                                    <span>{{ $data_carts[$i]['atribut'][$j]['jml_harga_tambahan'] }}</span>
                                                </td>
                                                <td class="pro-remove"><a href="#" data-toggle="modal"
                                                        data-target="#deleteAtribut{{ $data_carts[$i]['atribut'][$j]['cart_atribut_id'] }}"><i
                                                            class="fa fa-trash-o"></i></a></td>
                                            </tr>

                                            <!-- Elemen untuk dialog modal -->
                                            <div class="modal fade"
                                                id="deleteAtribut{{ $data_carts[$i]['atribut'][$j]['cart_atribut_id'] }}">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus atribut
                                                                <b>{{ $data_carts[$i]['atribut'][$j]['atribut_nama'] }}</b>
                                                                ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ route('cart_atribut_destroy', $data_carts[$i]['atribut'][$j]['cart_atribut_id']) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn__bg d-block">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    @endfor
                                    <tr class="total">
                                        <td colspan="4"></td>
                                        <td style="font-size: 15px;">
                                            Total
                                        </td>
                                        <td class="total-amount">Rp. {{ number_format($total_harga, 0, ',', '.') }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Cart Update Option -->
                    </div>
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <a href="checkout.php" class="btn btn__bg d-block">Proses Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout Login Coupon Accordion End -->
    </div>
@endsection
