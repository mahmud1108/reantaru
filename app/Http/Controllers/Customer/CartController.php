<?php

namespace App\Http\Controllers\Customer;

use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartAtribut;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
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
        dd(auth()->user());
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
        $cart = Cart::where('id', $cart)->where('customer_id', auth()->user()->id)->get();
        $kategoris = Kategori::all();

        if (count($cart) > 0) {
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
}
