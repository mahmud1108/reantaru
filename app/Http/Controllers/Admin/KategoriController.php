<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        $title = 'Kategori';

        return view(
            'admin.kategori.index',
            compact(
                'kategoris',
                'title'
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
    public function store(StoreKategoriRequest $request)
    {
        $image = FileHelper::instance()->upload($request->gambar_kategori, 'kategori');

        $kategori = new Kategori;
        $kategori->kategori_nama = $request->nama_kategori;
        $kategori->kategori_gambar = $image;
        $kategori->save();

        toast('Berhasil menambahkan data', 'success');
        return redirect()->route('kategori.index');
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
        FileHelper::instance()->delete($kategori->kategori_gambar);

        $kategori->delete();

        toast('Berhasil menghapus data', 'success');
        return redirect()->back();
    }
}
