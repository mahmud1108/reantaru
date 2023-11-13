<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return view(
            'shop.all_kategori',
            compact(
                'kategoris',
                'data_produk'
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
