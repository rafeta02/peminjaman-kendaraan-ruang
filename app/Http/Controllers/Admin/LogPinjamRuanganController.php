<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogPinjamRuangan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LogPinjamRuanganController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('log_pinjam_ruangan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LogPinjamRuangan::with(['peminjaman', 'ruang'])->select(sprintf('%s.*', (new LogPinjamRuangan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'log_pinjam_ruangan_show';
                $editGate      = 'log_pinjam_ruangan_edit';
                $deleteGate    = 'log_pinjam_ruangan_delete';
                $crudRoutePart = 'log-pinjam-ruangans';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('peminjaman_penggunaan', function ($row) {
                return $row->peminjaman ? $row->peminjaman->penggunaan : '';
            });

            $table->addColumn('ruang_name', function ($row) {
                return $row->ruang ? $row->ruang->name : '';
            });

            $table->editColumn('jenis', function ($row) {
                return $row->jenis ? LogPinjamRuangan::JENIS_SELECT[$row->jenis] : '';
            });
            $table->editColumn('log', function ($row) {
                return $row->log ? $row->log : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'peminjaman', 'ruang']);

            return $table->make(true);
        }

        return view('admin.logPinjamRuangans.index');
    }

    public function show(LogPinjamRuangan $logPinjamRuangan)
    {
        abort_if(Gate::denies('log_pinjam_ruangan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logPinjamRuangan->load('peminjaman', 'ruang');

        return view('admin.logPinjamRuangans.show', compact('logPinjamRuangan'));
    }
}
