<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\RegisterRequest;
use App\Models\Customer;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();

        $produks = Produk::all();

        $data_produk = [];
        foreach ($produks as $produk) {
            $galeris = [];
            foreach ($produk->galeri as $galeri) {
                if ($galeri->galeri_status == 'aktif') {
                    $galeris[] =
                        [
                            'galeri_id' => $galeri->id,
                            'galeri_file' => $galeri->galeri_file,
                            'galeri_status' => $galeri->galeri_status
                        ];
                }
            }
            $data_produk[] =
                [
                    'produk_nama' => $produk->produk_nama,
                    'produk_slug' => $produk->produk_slug,
                    'produk_harga' => $produk->produk_harga,
                    'produk_kategori' => $produk->kategori->kategori_nama,
                    'produk_keterangan' => $produk->produk_keterangan,
                    'galeri' => $galeris
                ];
        }

        // return response()->json($data_produk);
        return view(
            'shop.index',
            compact(
                'kategoris',
                'data_produk'
            )
        );
    }

    public function satu_kategori($slug)
    {
        $kategoris = Kategori::all();

        $kategori = Kategori::where('kategori_nama', $slug)->first();

        if ($kategori === null) {
            return view('shop.satu_kategori', compact(
                'kategoris',
                'kategori'
            ));
        }

        $produks = Produk::where('kategori_id', $kategori->id)->get();
        $data_produk = [];
        foreach ($produks as $produk) {
            $galeris = [];
            foreach ($produk->galeri as $galeri) {
                if ($galeri->galeri_status == 'aktif') {
                    $galeris[] =
                        [
                            'galeri_id' => $galeri->id,
                            'galeri_file' => $galeri->galeri_file,
                            'galeri_status' => $galeri->galeri_status
                        ];
                }
            }
            $data_produk[] =
                [
                    'produk_nama' => $produk->produk_nama,
                    'produk_slug' => $produk->produk_slug,
                    'produk_harga' => $produk->produk_harga,
                    'produk_kategori' => $produk->kategori->kategori_nama,
                    'produk_keterangan' => $produk->produk_keterangan,
                    'galeri' => $galeris
                ];
        }

        return view('shop.satu_kategori', compact(
            'kategoris',
            'data_produk',
            'kategori'
        ));
    }

    public function login_form()
    {
        $kategoris = Kategori::all();
        return view(
            'shop.login_register',
            compact('kategoris')
        );
    }

    public function register_act(RegisterRequest $request)
    {
        $customer = new Customer;
        $customer->customer_nama = $request->nama;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->save();

        session()->flash('text', 'Berhasil registrasi');
        session()->flash('type', 'success');
        return redirect()->back();
    }

    public function login_act(Request $request)
    {
        $creds = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        if (Auth::guard('customer')->attempt($creds) === true) {
            return redirect()->route('shop-index');
        }

        session()->flash('text', 'Email dan password tidak cocok');
        session()->flash('type', 'danger');
        return redirect()->back();
    }

    public function produk()
    {
        $kategoris = Kategori::all();

        $produks = Produk::all();

        $data_produk = [];
        foreach ($produks as $produk) {
            $galeris = [];
            foreach ($produk->galeri as $galeri) {
                if ($galeri->galeri_status == 'aktif') {
                    $galeris[] =
                        [
                            'galeri_id' => $galeri->id,
                            'galeri_file' => $galeri->galeri_file,
                            'galeri_status' => $galeri->galeri_status
                        ];
                }
            }
            $data_produk[] =
                [
                    'produk_nama' => $produk->produk_nama,
                    'produk_slug' => $produk->produk_slug,
                    'produk_harga' => $produk->produk_harga,
                    'produk_kategori' => $produk->kategori->kategori_nama,
                    'produk_keterangan' => $produk->produk_keterangan,
                    'galeri' => $galeris
                ];
        }

        return view(
            'shop.produk',
            compact(
                'kategoris',
                'data_produk'
            )
        );
    }

    public function all_kategori()
    {
        $kategoris = Kategori::all();

        $produks = Produk::all();

        $data_produk = [];
        foreach ($produks as $produk) {
            $galeris = [];
            foreach ($produk->galeri as $galeri) {
                if ($galeri->galeri_status == 'aktif') {
                    $galeris[] =
                        [
                            'galeri_id' => $galeri->id,
                            'galeri_file' => $galeri->galeri_file,
                            'galeri_status' => $galeri->galeri_status
                        ];
                }
            }
            $data_produk[] =
                [
                    'produk_nama' => $produk->produk_nama,
                    'produk_slug' => $produk->produk_slug,
                    'produk_harga' => $produk->produk_harga,
                    'produk_kategori' => $produk->kategori->kategori_nama,
                    'produk_keterangan' => $produk->produk_keterangan,
                    'galeri' => $galeris
                ];
        }

        return view(
            'shop.all_kategori',
            compact(
                'kategoris',
                'data_produk'
            )
        );
    }

    public function tentang()
    {
        $kategoris = Kategori::all();

        return view(
            'shop.tentang_kami',
            compact('kategoris')
        );
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $produks = Produk::search($query)->get();

        $kategoris = Kategori::all();

        $data_produk = [];
        foreach ($produks as $produk) {
            $galeris = [];
            foreach ($produk->galeri as $galeri) {
                if ($galeri->galeri_status == 'aktif') {
                    $galeris[] =
                        [
                            'galeri_id' => $galeri->id,
                            'galeri_file' => $galeri->galeri_file,
                            'galeri_status' => $galeri->galeri_status
                        ];
                }
            }
            $data_produk[] =
                [
                    'produk_nama' => $produk->produk_nama,
                    'produk_slug' => $produk->produk_slug,
                    'produk_harga' => $produk->produk_harga,
                    'produk_kategori' => $produk->kategori->kategori_nama,
                    'produk_keterangan' => $produk->produk_keterangan,
                    'galeri' => $galeris
                ];
        }

        return view(
            'shop.search',
            compact(
                'kategoris',
                'data_produk',
                'query'
            )
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();;
        $request->session()->regenerateToken();

        return redirect()->route('login_form_customer');
    }
}
