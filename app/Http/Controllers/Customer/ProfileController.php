<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Kategori;
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

        return view(
            'shop.my-account',
            compact(
                'kategoris'
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
