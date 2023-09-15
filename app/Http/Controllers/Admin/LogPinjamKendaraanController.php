<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogPinjamKendaraan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LogPinjamKendaraanController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('log_pinjam_kendaraan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LogPinjamKendaraan::with(['peminjaman', 'kendaraan', 'peminjam'])->select(sprintf('%s.*', (new LogPinjamKendaraan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'log_pinjam_kendaraan_show';
                $editGate      = 'log_pinjam_kendaraan_edit';
                $deleteGate    = 'log_pinjam_kendaraan_delete';
                $crudRoutePart = 'log-pinjam-kendaraans';

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
                return $row->jenis ? LogPinjamKendaraan::JENIS_SELECT[$row->jenis] : '';
            });
            $table->editColumn('log', function ($row) {
                return $row->log ? $row->log : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'peminjaman', 'kendaraan', 'peminjam']);

            return $table->make(true);
        }

        return view('admin.logPinjamKendaraans.index');
    }

    public function show(LogPinjamKendaraan $logPinjamKendaraan)
    {
        abort_if(Gate::denies('log_pinjam_kendaraan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logPinjamKendaraan->load('peminjaman', 'kendaraan', 'peminjam');

        return view('admin.logPinjamKendaraans.show', compact('logPinjamKendaraan'));
    }
}
