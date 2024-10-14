<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index()
    {
        $mobil = Kendaraan::where('jenis', 'mobil')->count();
        $motor = Kendaraan::where('jenis', 'motor')->count();
        $available = Kendaraan::where('is_used', 0)->count();
        $dipinjam = Kendaraan::where('is_used', 1)->count();

        return view('frontend.home', compact('mobil', 'motor', 'available', 'dipinjam'));
    }
}
