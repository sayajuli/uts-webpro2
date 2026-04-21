<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class DashboardController extends Controller
{
    public function index()
    {
        $totalJurusan = Jurusan::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalMatakuliah = Matakuliah::count();

        return view('pages.dashboard', compact(
            'totalJurusan',
            'totalMahasiswa',
            'totalMatakuliah'
        ));
    }
}
