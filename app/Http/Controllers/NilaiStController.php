<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiStController extends Controller
{
    public function index()
    {
        // hitung total bobot dari masing-masing pelajaran tertentu
        $data = DB::select("SELECT 
                nama,
                nisn,
                SUM(CASE WHEN pelajaran_id = 44 THEN skor * 41.67 ELSE 0 END) AS verbal,
                SUM(CASE WHEN pelajaran_id = 45 THEN skor * 29.67 ELSE 0 END) AS kuantitatif,
                SUM(CASE WHEN pelajaran_id = 46 THEN skor * 100 ELSE 0 END) AS penalaran,
                SUM(CASE WHEN pelajaran_id = 47 THEN skor * 23.81 ELSE 0 END) AS figural
            FROM nilai
            WHERE materi_uji_id = 4
              AND pelajaran_id IN (44, 45, 46, 47)
            GROUP BY nama, nisn
        ");

        $result = collect($data)
            ->map(function ($item) {
                $total = $item->verbal + $item->kuantitatif + $item->penalaran + $item->figural;

                return [
                    'listNilai' => [
                        'figural' => round($item->figural, 2),
                        'kuantitatif' => round($item->kuantitatif, 2),
                        'penalaran' => round($item->penalaran, 2),
                        'verbal' => round($item->verbal, 2),
                    ],
                    'nama' => $item->nama,
                    'nisn' => $item->nisn,
                    'total' => round($total, 2),
                ];
            })
            ->sortByDesc('total') // urutan dari total terbesar
            ->values(); 

        return response()->json($result);
    }
}
