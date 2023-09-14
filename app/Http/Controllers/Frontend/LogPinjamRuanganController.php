<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LogPinjamRuangan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogPinjamRuanganController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('log_pinjam_ruangan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logPinjamRuangans = LogPinjamRuangan::with(['peminjaman', 'ruang'])->get();

        return view('frontend.logPinjamRuangans.index', compact('logPinjamRuangans'));
    }

    public function show(LogPinjamRuangan $logPinjamRuangan)
    {
        abort_if(Gate::denies('log_pinjam_ruangan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logPinjamRuangan->load('peminjaman', 'ruang');

        return view('frontend.logPinjamRuangans.show', compact('logPinjamRuangan'));
    }
}
