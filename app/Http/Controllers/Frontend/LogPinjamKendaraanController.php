<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LogPinjamKendaraan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogPinjamKendaraanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('log_pinjam_kendaraan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logPinjamKendaraans = LogPinjamKendaraan::with(['peminjaman', 'kendaraan', 'peminjam'])->get();

        return view('frontend.logPinjamKendaraans.index', compact('logPinjamKendaraans'));
    }

    public function show(LogPinjamKendaraan $logPinjamKendaraan)
    {
        abort_if(Gate::denies('log_pinjam_kendaraan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logPinjamKendaraan->load('peminjaman', 'kendaraan', 'peminjam');

        return view('frontend.logPinjamKendaraans.show', compact('logPinjamKendaraan'));
    }
}
