<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiRtController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT
                nama,
                nisn,
                SUM(CASE WHEN UPPER(nama_pelajaran) = 'REALISTIC' THEN skor ELSE 0 END) AS realistic,
                SUM(CASE WHEN UPPER(nama_pelajaran) = 'INVESTIGATIVE' THEN skor ELSE 0 END) AS investigative,
                SUM(CASE WHEN UPPER(nama_pelajaran) = 'ARTISTIC' THEN skor ELSE 0 END) AS artistic,
                SUM(CASE WHEN UPPER(nama_pelajaran) = 'SOCIAL' THEN skor ELSE 0 END) AS social,
                SUM(CASE WHEN UPPER(nama_pelajaran) = 'ENTERPRISING' THEN skor ELSE 0 END) AS enterprising,
                SUM(CASE WHEN UPPER(nama_pelajaran) = 'CONVENTIONAL' THEN skor ELSE 0 END) AS conventional
            FROM nilai
            WHERE materi_uji_id = 7
              AND UPPER(nama_pelajaran) != 'PELAJARAN KHUSUS'
            GROUP BY nama, nisn
        ");

        $result = collect($data)->map(function ($item) {
            return [
                'nama' => $item->nama,
                'nilaiRT' => [
                    'realistic' => (int) $item->realistic,
                    'investigative' => (int) $item->investigative,
                    'artistic' => (int) $item->artistic,
                    'social' => (int) $item->social,
                    'enterprising' => (int) $item->enterprising,
                    'conventional' => (int) $item->conventional,
                ],
                'nisn' => $item->nisn,
            ];
        });

        return response()->json($result);
    }
}
