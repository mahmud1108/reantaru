<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelIgnition\Solutions\MakeViewVariableOptionalSolution;

class LoginAdminController extends Controller
{
    public function login(Request $request)
    {

        // $admin = new Admin;
        // $admin->username = 'admin';
        // $admin->password = Hash::make('admin');;
        // $admin->role = 'super admin';
        // $admin->status = 'aktif';
        // $admin->foto = 'aktif';
        // $admin->no_hp = 'aktif';
        // $admin->save();

        $creds = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
        // dd(Auth::guard('admin')->attempt($creds));
        if (Auth::attempt($creds) === true) {
            toast('Berhasil login sebagai ' . auth()->user()->role, 'success');
            return redirect()->route('admin-dashboard');
        }
        toast('Username dan password tidak cocok', 'error');
        return redirect()->route('login-admin');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();;
        $request->session()->regenerateToken();
        return redirect()->route('login-admin');
    }
}
