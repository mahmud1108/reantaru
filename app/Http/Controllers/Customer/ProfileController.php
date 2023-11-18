<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    protected $kategoris;
    public function __construct()
    {
        $this->kategoris = Kategori::all();
    }

    public function index()
    {
        $kategoris = $this->kategoris;

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
        // return response()->json($data_carts);

        return view(
            'shop.my-account',
            compact(
                'kategoris',
                'data_carts',
                'total_harga'
            )
        );
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:5']
        ]);
        $password = Hash::make($request->password);

        Customer::where('id', auth()->user()->id)->update([
            'password' => $password
        ]);

        session()->flash('text', 'Berhasil mengubah password');
        session()->flash('type', 'success');
        return redirect()->back();
    }

    public function profil_update(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'min:5'],
            'email' => ['email', 'required', Rule::unique('customers')->ignore(auth()->user()->id)],
            'customer_hp' => ['required', Rule::unique('customers')->ignore(auth()->user()->id), 'regex:/^08[0-9]{8,15}$/']
        ]);
        Customer::where('id', auth()->user()->id)
            ->update([
                'customer_nama' => $request->nama,
                'email' => $request->email,
                'customer_hp' => $request->customer_hp
            ]);

        session()->flash('text', 'Berhasil mengubah profil');
        session()->flash('type', 'success');
        return redirect()->back();
    }
}
