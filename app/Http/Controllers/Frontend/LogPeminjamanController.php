<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LogPeminjaman;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogPeminjamanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('log_peminjaman_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logPeminjamen = LogPeminjaman::with(['peminjaman', 'kendaraan', 'peminjam'])->get();

        return view('frontend.logPeminjamen.index', compact('logPeminjamen'));
    }

    public function show(LogPeminjaman $logPeminjaman)
    {
        abort_if(Gate::denies('log_peminjaman_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logPeminjaman->load('peminjaman', 'kendaraan', 'peminjam');

        return view('frontend.logPeminjamen.show', compact('logPeminjaman'));
    }
}
