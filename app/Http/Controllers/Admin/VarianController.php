<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVarianRequest;
use App\Http\Requests\Admin\UpdateVarianRequest;
use App\Models\Produk;
use App\Models\Varian;
use Illuminate\Http\Request;

class VarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Varian $varian)
    {
        //
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
    public function store(StoreVarianRequest $request)
    {
        $varian = new Varian;
        $varian->produk_id = $request->produk_id;
        $varian->varian_nama = $request->nama_varian;
        $varian->save();

        toast("Berhasil menambahkan varian baru", 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($varian)
    {
        $produk = Produk::where('id', $varian)->first();
        $varians = Varian::where('produk_id', $varian)->get();
        $title = "Varian " . $produk->produk_nama;

        return view(
            'admin.varian.index',
            compact(
                'varians',
                'title',
                'produk'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Varian $varian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVarianRequest $request, Varian $varian)
    {
        Varian::where('id', $varian->id)
            ->update([
                'varian_nama' => $request->nama_varian
            ]);

        toast("Berhasil merubah varian", "success");;
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Varian $varian)
    {
        $varian->delete();

        toast("Berhasil menghapus data", 'success');
        return redirect()->back();
    }
}
