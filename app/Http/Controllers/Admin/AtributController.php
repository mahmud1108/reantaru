<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAtributRequest;
use App\Http\Requests\Admin\UpdateAtributRequest;
use App\Models\Atribut;
use App\Models\Varian;
use Illuminate\Http\Request;

class AtributController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(StoreAtributRequest $request)
    {
        $atribut = new Atribut;
        $atribut->varian_id = $request->varian_id;
        $atribut->atribut_nama = $request->atribut_nama;
        $atribut->harga_tambahan = $request->harga_tambahan;
        $atribut->save();

        toast("Berhasil menambahkan atribut baru", 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($varian)
    {
        $get_varian = Varian::where('id', $varian)->first();
        $title = 'Atribut varian | ' . $get_varian->varian_nama;
        $atributs = Atribut::where('varian_id', $varian)->get();

        return view(
            'admin.atribut.index',
            compact(
                'get_varian',
                'title',
                'atributs'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atribut $atribut)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAtributRequest $request, $atribut)
    {
        Atribut::where('id', $atribut)
            ->update([
                'atribut_nama' => $request->nama_atribut,
                'harga_tambahan' => $request->harga_tambahan
            ]);

        toast('Berhasil mengubah atribut', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atribut $atribut)
    {
        $atribut->delete();
        toast("Berhasil menghapus data", 'success');
        return redirect()->back();
    }
}
