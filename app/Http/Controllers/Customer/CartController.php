<?php

namespace App\Http\Controllers\Customer;

use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartAtribut;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

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
        //
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
}
