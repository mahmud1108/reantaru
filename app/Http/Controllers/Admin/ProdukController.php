<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProdukRequest;
use App\Http\Requests\Admin\UpdateProdukRequest;
use App\Models\Galeri;
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

        $jumlah = count($request->gambar);

        if ($jumlah > 1) {
            $produk = new Produk;
            $produk->produk_nama = $request->produk_nama;
            $produk->produk_harga = $request->produk_harga;
            $produk->kategori_id = $request->kategori_id;
            $produk->produk_keterangan = $request->produk_keterangan;
            $produk->produk_tanggal = $date;
            $produk->save();

            $get_last = Produk::latest('created_at')->first();

            for ($i = 0; $i < $jumlah; $i++) {
                $gambar =  FileHelper::instance()->upload($request->gambar[$i], 'produk');

                $galeri = new Galeri;
                $galeri->galeri_file = $gambar;
                $galeri->produk_id = $get_last->id;
                $galeri->galeri_status = 'aktif';
                $galeri->save();
            }

            toast("Berhasil menambahkan data baru", "success");
            return redirect()->route('produk.index');
        }
        $gambar =  FileHelper::instance()->upload($request->gambar[0], 'produk');

        $produk = new Produk;
        $produk->produk_nama = $request->produk_nama;
        $produk->produk_harga = $request->produk_harga;
        $produk->kategori_id = $request->kategori_id;
        $produk->produk_keterangan = $request->produk_keterangan;
        $produk->produk_tanggal = $datetime;
        $produk->save();

        $get_last = Produk::latest('created_at')->first();

        $galeri = new Galeri;
        $galeri->galeri_file = $gambar;
        $galeri->produk_id = $get_last->id;
        $galeri->galeri_status = "aktif";
        $galeri->save();

        toast("Berhasil menambahkan data baru", "success");
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
        dd($request->all());
        Produk::where('id', $produk->id)
            ->update([
                'produk_nama' => $request->produk_nama,
                'produk_harga' => $request->produk_harga,
                'kategori_id' => $request->kategori_id,
                'produk_keterangan' => $request->produk_keterangan,
                'produk_status' => $request->produk_status
            ]);

        toast("Berhasil mengubah data " . $produk->produk_nama, 'success');
        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $galeris = Galeri::where('produk_id', $produk->id)->get();
        if (count($galeris) > 1) {
            foreach ($galeris as $galeri) {
                FileHelper::instance()->delete($galeri->galeri_file);
            }
        } else {
            $galeri = Galeri::where('produk_id', $produk->id)->first();
            FileHelper::instance()->delete($galeri->galeri_file);
        }

        $produk->delete();

        toast('Produk berhasil dihapus', 'success');
        return redirect()->route('produk.index');
    }
}
