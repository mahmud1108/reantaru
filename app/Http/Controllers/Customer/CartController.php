<?php

namespace App\Http\Controllers\Customer;

use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartAtribut;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
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
    public function show(Cart $cart)
    {
        $kategoris = Kategori::all();

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
        dd($cart, $request->all());
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
