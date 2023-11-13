<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

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
        $kategori = Kategori::where('kategori_nama', $slug)->first();
    }
}
