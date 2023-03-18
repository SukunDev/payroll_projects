<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function index()
    {
        return view("pegawai.index", [
            "title" => "Pegawai Dashboard",
        ]);
    }
    public function postIndex(Request $request)
    {
        $request->validate([
            "tanggal" => "required",
            "jam_masuk" => "required",
            "jam_keluar" => "required",
        ]);
        $user = Auth::user();
        $checkAbsensi = Absensi::where("user_id", $user->id)
            ->whereDate("created_at", $request->tanggal)
            ->get();
        if ($checkAbsensi) {
            return back()->with([
                "alert" => "warning",
                "pesan" => "you already make absensi today",
            ]);
        }
        $status = "tidak hadir";
        if (
            strtotime($request->jam_masuk) >
            strtotime($user->usersalaries->jam_masuk)
        ) {
            $status = "telat";
        } else {
            $status = "hadir";
        }
        $createAbsensi = Absensi::create([
            "user_id" => $user->id,
            "jam_masuk" => $request->jam_masuk,
            "jam_keluar" => $request->jam_keluar,
            "status" => $status,
            "created_at" => $request->tanggal,
            "updated_at" => $request->tanggal,
        ]);
        return back()->with([
            "alert" => "success",
            "pesan" => "berhasil melakukan absensi hari ini",
        ]);
    }
}
