<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\User;
use App\Models\UserSalary;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "admin",
            "email" => "admin@admin",
            "password" => bcrypt("admin"),
            "is_admin" => true,
        ]);
        $pegawai = User::create([
            "name" => "Jhon Doe",
            "email" => "pegawai@pegawai",
            "password" => bcrypt("pegawai"),
        ]);
        UserSalary::create([
            "user_id" => $pegawai->id,
            "gaji" => 3000000,
            "denda" => 50000,
        ]);
        $pegawai = User::create([
            "name" => "Rohmad Sa'roni",
            "email" => "roni@pegawai",
            "password" => bcrypt("pegawai"),
        ]);
        UserSalary::create([
            "user_id" => $pegawai->id,
            "gaji" => 3000000,
            "denda" => 50000,
        ]);
        $jamMasuk = "09:00:00";
        $jamKeluar = "16:00:00";
        $telat = "09:30:00";
        for ($x = 0; $x < date("t"); $x++) {
            $rand = rand(0, 9) > 2 ? 1 : 0;
            Absensi::create([
                "user_id" => $pegawai->id,
                "jam_masuk" => $rand == 1 ? $jamMasuk : $telat,
                "jam_keluar" => $jamKeluar,
                "status" => $rand == 1 ? "hadir" : "telat",
                "created_at" => $x + 1 . "-" . date("m") . "-" . date("Y"),
                "updated_at" => $x + 1 . "-" . date("m") . "-" . date("Y"),
            ]);
        }
    }
}
