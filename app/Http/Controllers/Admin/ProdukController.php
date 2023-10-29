<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProdukRequest;
use App\Http\Requests\Admin\UpdateProdukRequest;
use App\Models\Kategori;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        setlocale(LC_TIME, 'id_ID.utf8');

        $produks = Produk::all();
        $title = "Produk";
        $kategoris = Kategori::all();

        $data = [];
        foreach ($produks as $produk) {
            $date = Carbon::parse($produk->produk_tanggal);
            $formattedDate = $date->isoFormat('D MMMM Y');
            $data[] =
                [
                    'tanggal' => $formattedDate
                ];
        }

        return view(
            'admin.produk.index',
            compact(
                'produks',
                'title',
                'kategoris',
                'data'
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
    public function store(StoreProdukRequest $request)
    {
        $date = Carbon::now();
        $datetime = $date->format('Y-m-d');

        $produk = new Produk;
        $produk->produk_nama = $request->produk_nama;
        $produk->produk_harga = $request->produk_harga;
        $produk->kategori_id = $request->kategori_id;
        $produk->produk_keterangan = $request->produk_keterangan;
        $produk->produk_tanggal = $datetime;
        $produk->save();

        return redirect()->route('produk.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        Produk::where('id', $produk->id)
            ->update([
                'produk_nama' => $request->produk_nama,
                'produk_harga' => $request->produk_harga,
                'kategori_id' => $request->kategori_id,
                'produk_keterangan' => $request->produk_keterangan
            ]);

        toast("Berhasil mengubah data " . $produk->produk_nama, 'success');
        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();

        toast('Produk berhasil dihapus', 'success');
        return redirect()->route('produk.index');
    }
}
