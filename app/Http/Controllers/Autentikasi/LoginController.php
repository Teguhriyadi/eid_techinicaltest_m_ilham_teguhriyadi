<?php

namespace App\Http\Controllers\Autentikasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Autentikasi\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login()
    {
        return view("autentikasi.login");
    }

    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return redirect()
                ->intended('/pages/dashboard')
                ->with('success', 'Anda Berhasil Login');
        }

        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password tidak sesuai.');
    }

    public function logout()
    {
        try {
            DB::beginTransaction();

            Auth::logout();

            DB::commit();

            return redirect()
                ->to("/auth/login")
                ->with("success", "Anda Berhasil Logout");
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }
}
