<?php

namespace App\Helpers;

use Carbon\Carbon;

class AppHelper
{
    public function makeLaporan($statistics)
    {
        $totalHadir = 0;
        $totalTelat = 0;
        for ($x = 0; $x < date("t"); $x++) {
            $jam_masuk = "-";
            $jam_keluar = "-";
            $status = "-";
            foreach ($statistics as $viewDays) {
                if (
                    Carbon::parse($viewDays->created_at)->format("d") ==
                    $x + 1
                ) {
                    $jam_masuk = $viewDays->jam_masuk;
                    $jam_keluar = $viewDays->jam_keluar;
                    $status = $viewDays->status;
                    switch ($viewDays->status) {
                        case "hadir":
                            $totalHadir++;
                            break;

                        default:
                            $totalTelat++;
                            break;
                    }
                }
            }
            $data[] = [
                "date" => Carbon::parse(now())->format("Y-m-") . ($x + 1),
                "jam_keluar" => $jam_keluar,
                "jam_masuk" => $jam_masuk,
                "status" => $status,
            ];
        }
        return [
            "total_hadir" => $totalHadir,
            "total_telat" => $totalTelat,
            "laporan" => $data,
        ];
    }
    public static function instance()
    {
        return new AppHelper();
    }
}
