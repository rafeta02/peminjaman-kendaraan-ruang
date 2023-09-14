<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogPeminjaman;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LogPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('log_peminjaman_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LogPeminjaman::with(['peminjaman', 'kendaraan', 'peminjam'])->select(sprintf('%s.*', (new LogPeminjaman)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'log_peminjaman_show';
                $editGate      = 'log_peminjaman_edit';
                $deleteGate    = 'log_peminjaman_delete';
                $crudRoutePart = 'log-peminjamen';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('peminjaman_reason', function ($row) {
                return $row->peminjaman ? $row->peminjaman->reason : '';
            });

            $table->editColumn('peminjaman.reason', function ($row) {
                return $row->peminjaman ? (is_string($row->peminjaman) ? $row->peminjaman : $row->peminjaman->reason) : '';
            });
            $table->addColumn('kendaraan_plat_no', function ($row) {
                return $row->kendaraan ? $row->kendaraan->plat_no : '';
            });

            $table->editColumn('kendaraan.merk', function ($row) {
                return $row->kendaraan ? (is_string($row->kendaraan) ? $row->kendaraan : $row->kendaraan->merk) : '';
            });
            $table->addColumn('peminjam_name', function ($row) {
                return $row->peminjam ? $row->peminjam->name : '';
            });

            $table->editColumn('jenis', function ($row) {
                return $row->jenis ? LogPeminjaman::JENIS_SELECT[$row->jenis] : '';
            });
            $table->editColumn('log', function ($row) {
                return $row->log ? $row->log : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'peminjaman', 'kendaraan', 'peminjam']);

            return $table->make(true);
        }

        return view('admin.logPeminjamen.index');
    }

    public function show(LogPeminjaman $logPeminjaman)
    {
        abort_if(Gate::denies('log_peminjaman_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logPeminjaman->load('peminjaman', 'kendaraan', 'peminjam');

        return view('admin.logPeminjamen.show', compact('logPeminjaman'));
    }
}
