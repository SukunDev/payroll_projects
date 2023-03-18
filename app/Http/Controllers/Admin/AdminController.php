<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use App\Models\UserSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.index", [
            "title" => "Dashboard",
        ]);
    }
    public function pegawai()
    {
        $pegawai = UserSalary::paginate(10);
        return view("admin.pegawai.index", [
            "title" => "Pegawai",
            "pegawai" => $pegawai,
        ]);
    }
    public function showPegawai(UserSalary $pegawai)
    {
        $absensi = Absensi::where("user_id", $pegawai->user->id)
            ->whereMonth("created_at", Carbon::now()->month)
            ->get();
        return view("admin.pegawai.show.index", [
            "title" => $pegawai->user->name,
            "pegawai" => $pegawai,
            "laporan" => AppHelper::instance()->makeLaporan($absensi),
        ]);
    }
    public function pegawaiPost(Request $request)
    {
        $request->validate([
            "email" => "required",
            "name" => "required|min:5",
            "password" => "required|min:5",
            "jam_masuk" => "required|date_format:H:i",
            "jam_keluar" => "required|date_format:H:i|after:jam_masuk",
            "gaji" => "required|int",
            "denda" => "required|int",
        ]);
        $user = User::create([
            "name" => $request->name,
            "password" => Hash::make($request->password),
            "email" => $request->email,
        ]);
        if (!$user) {
            return back()->with([
                "alert" => "error",
                "pesan" => "error when create user",
            ]);
        }
        $userSalary = UserSalary::create([
            "user_id" => $user->id,
            "gaji" => $request->gaji,
            "denda" => $request->denda,
            "jam_masuk" => $request->jam_masuk,
            "jam_keluar" => $request->jam_keluar,
        ]);
        if (!$userSalary) {
            return back()->with([
                "alert" => "error",
                "pesan" => "error when create user salary",
            ]);
        }
        return back()->with([
            "alert" => "success",
            "pesan" => "success to create user",
        ]);
    }
    public function editPegawai(UserSalary $pegawai, Request $request)
    {
        $pegawai->user->name = $request->name;
        $pegawai->user->save();
        $pegawai->gaji = $request->gaji;
        $pegawai->denda = $request->denda;
        $pegawai->save();
        return back()->with([
            "alert" => "success",
            "pesan" => "success to change user",
        ]);
    }
    public function deletePegawai(UserSalary $pegawai)
    {
        $pegawai->delete();
        Absensi::where("user_id", $pegawai->user_id)->delete();
        User::find($pegawai->user_id)->delete();
        return redirect("/admin/pegawai")->with([
            "alert" => "success",
            "pesan" => "success to delete user",
        ]);
    }
}
