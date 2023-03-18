<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view("auth.index", [
            "title" => "Sign In",
        ]);
    }
    public function postIndex(Request $request)
    {
        $user = Auth::attempt([
            "email" => $request->email,
            "password" => $request->password,
        ]);
        if ($user) {
            $request->session()->regenerate();
            if (Auth::user()->is_admin) {
                return redirect()->intended("/admin");
            }
            return redirect()->intended("/pegawai");
        }
        return back()->with([
            "alert" => "error",
            "pesan" => "Check your login information",
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/auth/signin");
    }
}
