<?php

namespace App\Http\Controllers\Customer;

use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartAtribut;
use App\Models\City;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Province;
use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Monolog\Handler\DeduplicationHandler;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();

        $data_carts_modal = [];
        if (auth()->user()) {
            $carts = Cart::where('customer_id', auth()->user()->id)->get();
            foreach ($carts as $cart) {
                $cart_atributs = [];
                foreach ($cart->cart_atribut as $cart_atribut) {
                    $jml_harga_atribut =  $cart->cart_jumlah * $cart_atribut->atribut->harga_tambahan;
                    $cart_atributs[] =
                        [
                            'cart_atribut_id' => $cart_atribut->id,
                            'atribut_nama' => $cart_atribut->atribut->atribut_nama,
                            'varian_nama' => $cart_atribut->atribut->varian->varian_nama,
                            'harga_tambahan' => $cart_atribut->atribut->harga_tambahan,
                            'jml_harga_tambahan' => $jml_harga_atribut
                        ];
                }
                $galeris = [];
                foreach ($cart->produk->galeri as $galeri) {
                    if ($galeri->galeri_status == 'aktif') {
                        $galeris[] =
                            [
                                'galeri_id' => $galeri->id,
                                'galeri_file' => $galeri->galeri_file
                            ];
                        break;
                    }
                }

                $jml_harga =  $cart->produk->produk_harga * $cart->cart_jumlah;
                if (count($cart_atributs) < 1) {
                    $data_carts_modal[] =
                        [
                            'cart_id' => $cart->id,
                            'cart_jumlah' => $cart->cart_jumlah,
                            'produk_nama' => $cart->produk->produk_nama,
                            'produk_harga' => $cart->produk->produk_harga,
                            'galeri' => $galeris,
                            'cart_atribut' => $cart_atributs,
                            'total_harga' => $jml_harga
                        ];
                } else {
                    $total = 0;
                    for ($i = 0; $i < count($cart_atributs); $i++) {
                        $total += $cart_atributs[$i]['jml_harga_tambahan'];
                    }
                    $data_carts_modal[] =
                        [
                            'cart_id' => $cart->id,
                            'cart_jumlah' => $cart->cart_jumlah,
                            'produk_nama' => $cart->produk->produk_nama,
                            'produk_harga' => $cart->produk->produk_harga,
                            'galeri' => $galeris,
                            'cart_atribut' => $cart_atributs,
                            'total_harga' => $jml_harga + $total
                        ];
                }
            }

            $total_harga_modal = 0;
            for ($i = 0; $i < count($data_carts_modal); $i++) {
                $total_harga_modal += $data_carts_modal[$i]['total_harga'];
            }
        } else {
            $data_carts_modal = [];
        }

        if (auth()->user()) {
            $jml_cart = Cart::where('customer_id', auth()->user()->id)->count();
        } else {
            $jml_cart = 0;
        }

        $carts = Cart::where('customer_id', auth()->user()->id)->get();
        $data_carts = [];
        foreach ($carts as $cart) {
            $cart_atributs = [];
            foreach ($cart->cart_atribut as $cart_atribut) {
                $jml_harga_atribut =  $cart->cart_jumlah * $cart_atribut->atribut->harga_tambahan;

                $cart_atributs[] =
                    [
                        'cart_atribut_id' => $cart_atribut->id,
                        'atribut_id' => $cart_atribut->atribut_id,
                        'varian_nama' => $cart_atribut->atribut->varian->varian_nama,
                        'atribut_nama' => $cart_atribut->atribut->atribut_nama,
                        'harga_tambahan' => 'Rp.' . number_format($cart_atribut->atribut->harga_tambahan, 0, ',', '.'),
                        'jml_harga_tambahan' => 'Rp.' . number_format($jml_harga_atribut, 0, ',', '.'),
                        'total_harga_tambahan' => $jml_harga_atribut
                    ];
            }

            $produks = Produk::where('id', $cart->produk_id)->get();
            foreach ($produks as $produk) {
                $galeris = [];
                foreach ($produk->galeri as $galeri) {
                    if ($galeri->galeri_status == 'aktif') {
                        $galeris[] =
                            [
                                'galeri' => $galeri->galeri_file
                            ];
                    }
                }
            }

            $jml_harga =  $cart->produk->produk_harga * $cart->cart_jumlah;
            if (count($cart_atributs) < 1) {
                $data_carts[] =
                    [
                        'cart_id' => $cart->id,
                        'cart_jumlah' => $cart->cart_jumlah,
                        'cart_keterangan' => $cart->cart_keterangan,
                        'cart_file' => $cart->cart_file,
                        'produk_nama' => $cart->produk->produk_nama,
                        'produk_harga' => 'Rp.' . number_format($cart->produk->produk_harga, 0, ',', '.'),
                        'jml_harga' =>  'Rp.' . number_format($jml_harga, 0, ',', '.'),
                        'total' => $jml_harga,
                        'produk_thumb' => $galeris,
                        'atribut' => $cart_atributs,
                    ];
            } else {
                $total = 0;
                for ($i = 0; $i < count($cart_atributs); $i++) {
                    $total += $cart_atributs[$i]['total_harga_tambahan'];
                }

                $data_carts[] =
                    [
                        'cart_id' => $cart->id,
                        'cart_jumlah' => $cart->cart_jumlah,
                        'cart_keterangan' => $cart->cart_keterangan,
                        'cart_file' => $cart->cart_file,
                        'produk_nama' => $cart->produk->produk_nama,
                        'produk_harga' => 'Rp.' . number_format($cart->produk->produk_harga, 0, ',', '.'),
                        'jml_harga' =>  'Rp.' . number_format($jml_harga, 0, ',', '.'),
                        'total' => $total + $jml_harga,
                        'produk_thumb' => $galeris,
                        'atribut' => $cart_atributs,
                    ];
            }
        }

        $total_harga = 0;
        for ($i = 0; $i < count($data_carts); $i++) {
            $total_harga += $data_carts[$i]['total'];
        }
        return view(
            'shop.cart',
            compact(
                'kategoris',
                'data_carts',
                'total_harga',
                'jml_cart',
                'data_carts_modal',
                'total_harga_modal'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = new Cart;
        $cart->customer_id = auth()->user()->id;
        $cart->produk_id = $request->produk_id;
        $cart->cart_jumlah = $request->jumlah;
        $cart->cart_keterangan = $request->keterangan;
        $cart->cart_file = FileHelper::instance()->upload($request->foto, 'customer_cart_file');
        $cart->save();

        if ($request->varian0 != null) {
            $get_last_cart = $cart->id;
            for ($i = 0; $i < $request->no_var; $i++) {
                $varian = 'varian' . $i;
                $cart_atribut = new CartAtribut;
                $cart_atribut->cart_id = $get_last_cart;
                $cart_atribut->atribut_id = $request->$varian;
                $cart_atribut->save();
            }
        }
        return redirect()->route('my-acc');
    }

    /**
     * Display the specified resource.
     */
    public function show($cart)
    {
        $cart = Cart::where('id', $cart)->where('customer_id', auth()->user()->id)->first();

        $kategoris = Kategori::all();

        if ($cart !== null) {
            $galeris = [];
            foreach ($cart->produk->galeri as $galeri) {
                if ($galeri->galeri_status == 'aktif') {
                    $galeris[] =
                        [
                            'galeri_id' => $galeri->id,
                            'galeri_file' => $galeri->galeri_file,
                            'galeri_status' => $galeri->galeri_status
                        ];
                }
            }

            $cart_atributs = [];
            foreach ($cart->cart_atribut as $cart_atribut) {
                $cart_atributs[] =
                    [
                        'cart_atribut_id' => $cart_atribut->id,
                        'atribut_id' => $cart_atribut->atribut_id,
                        'atribut_nama' => $cart_atribut->atribut->atribut_nama
                    ];
            }

            $varians = [];
            foreach ($cart->produk->varian as $varian) {
                $atributs = [];
                foreach ($varian->atribut as $atribut) {
                    $atributs[] =
                        [
                            'atribut_id' => $atribut->id,
                            'atribut_nama' => $atribut->atribut_nama,
                            'harga_tambahan' => $atribut->harga_tambahan
                        ];
                }
                $varians[] =
                    [
                        'varian_id' => $varian->id,
                        'varian_nama' => $varian->varian_nama,
                        'atribut' => $atributs
                    ];
            }


            $path = $cart->cart_file;
            $pathParts = explode('/', $path);
            $lastWord = end($pathParts);

            return view(
                'shop.detail_cart',
                compact(
                    'kategoris',
                    'galeris',
                    'cart_atributs',
                    'cart',
                    'varians',
                    'lastWord'
                )
            );
        }

        abort(404, 'Cart not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        // dd($request->all());
        if (!$request->foto) {
            $cart->cart_jumlah = $request->jumlah;
            $cart->cart_keterangan = $request->keterangan;
            $cart->update();

            if ($request->cart_atribut > 0) {
                for ($i = 0; $i < $request->cart_atribut; $i++) {
                    $cart_atribut_id = 'cart_atribut_id' . $i;
                    if ($request->$cart_atribut_id == null) {
                        break;
                    }
                    $cek_cart_atribut_id = CartAtribut::where('id', $request->$cart_atribut_id)->get();
                }
            } else {
                $cek_cart_atribut_id = [];
            }

            if ($request->varian0 !== null) {
                if (count($cek_cart_atribut_id) === 0) {
                    for ($i = 0; $i < $request->no_var; $i++) {
                        $varian = 'varian' . $i;
                        $cart_atribut = new CartAtribut;
                        $cart_atribut->cart_id = $cart->id;
                        $cart_atribut->atribut_id = $request->$varian;
                        $cart_atribut->save();
                    }
                } else {
                    foreach ($cek_cart_atribut_id as $hasil_cart_atribut) {

                        for ($i = 0; $i < $request->no_var; $i++) {
                            $varian = 'varian' . $i;
                            if ($request->$varian === null) {
                                break;
                            }

                            $hasil_cart_atribut->cart_id = $cart->id;
                            $hasil_cart_atribut->atribut_id = $request->$varian;
                            $hasil_cart_atribut->update();
                        }
                    }
                }
            }
            return redirect()->back();
        } else {

            FileHelper::instance()->delete($cart->cart_file);
            $file = FileHelper::instance()->upload($request->foto, 'customer_cart_file');

            $cart->cart_jumlah = $request->jumlah;
            $cart->cart_keterangan = $request->keterangan;
            $cart->cart_file = $file;
            $cart->update();

            if ($request->cart_atribut > 0) {
                for ($i = 0; $i < $request->cart_atribut; $i++) {
                    $cart_atribut_id = 'cart_atribut_id' . $i;
                    if ($request->$cart_atribut_id == null) {
                        break;
                    }
                    $cek_cart_atribut_id = CartAtribut::where('id', $request->$cart_atribut_id)->get();
                }
            } else {
                $cek_cart_atribut_id = [];
            }

            if ($request->varian0 !== null) {
                if (count($cek_cart_atribut_id) === 0) {
                    for ($i = 0; $i < $request->no_var; $i++) {
                        $varian = 'varian' . $i;
                        $cart_atribut = new CartAtribut;
                        $cart_atribut->cart_id = $cart->id;
                        $cart_atribut->atribut_id = $request->$varian;
                        $cart_atribut->save();
                    }
                } else {
                    foreach ($cek_cart_atribut_id as $hasil_cart_atribut) {

                        for ($i = 0; $i < $request->no_var; $i++) {
                            $varian = 'varian' . $i;
                            if ($request->$varian === null) {
                                break;
                            }

                            $hasil_cart_atribut->cart_id = $cart->id;
                            $hasil_cart_atribut->atribut_id = $request->$varian;
                            $hasil_cart_atribut->update();
                        }
                    }
                }
            }
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        FileHelper::instance()->delete($cart->cart_file);
        $cart->delete();

        return redirect()->back();
    }

    public function cart_atribut_destroy(CartAtribut $cartAtribut)
    {
        $cartAtribut->delete();

        return redirect()->back();
    }

    public function download($filename)
    {
        $disk = 'storage/customer_cart_file/' . $filename;

        if (file_exists($disk)) {

            return response()->download($disk);
        }

        abort(404, 'File not found');
    }

    public function province(Request $request)
    {
        try {
            $provinces = Province::where('name', 'like', '%' . $request->keyword . '%')->select('id', 'name')->get();
            $data = [];
            foreach ($provinces as $province) {
                $data[] = [
                    'id'    => $province->id,
                    'text'  => $province->name
                ];
            }

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Data Fetch Failed',
                'data'    => []
            ]);
        }
    }

    public function citites(Request $request)
    {
        $a = City::where('name', 'like', '%' . $request->keyword . '%')->get();
        // dd($cities);

        try {
            $province = Province::where('id', $request->province_id)->first();
            $cities = City::where('province_id', $province->id)->where('name', 'like', '%' . $request->keyword . '%')->get();

            $data = [];
            foreach ($cities as $city) {
                $data[] = [
                    'id'    => $city->id,
                    'text'  => $city->name
                ];
            }

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Data Fetch Failed',
                'data'    => []
            ]);
        }
    }

    public function cek(Request $request)
    {
        try {
            $response = Http::withOptions(['verify' => false,])->withHeaders([
                'key' => env('RAJAONGKIR_API_KEY')
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin'        => $request->origin,
                'destination'   => $request->destination,
                'weight'        => $request->weight,
                'courier'       => $request->courier
            ])
                ->json()['rajaongkir']['results'][0]['costs'];

            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'data'    => []
            ]);
        }
    }

    public function coba()
    {
        return view('shop.coba');
    }
}
