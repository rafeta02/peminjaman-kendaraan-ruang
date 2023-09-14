<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPinjamKendaraanRequest;
use App\Http\Requests\StorePinjamKendaraanRequest;
use App\Http\Requests\UpdatePinjamKendaraanRequest;
use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\PinjamKendaraan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PinjamKendaraanController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('pinjam_kendaraan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PinjamKendaraan::with(['kendaraan', 'borrowed_by', 'processed_by', 'driver', 'created_by'])->select(sprintf('%s.*', (new PinjamKendaraan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'pinjam_kendaraan_show';
                $editGate      = 'pinjam_kendaraan_edit';
                $deleteGate    = 'pinjam_kendaraan_delete';
                $crudRoutePart = 'pinjam-kendaraans';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('kendaraan_plat_no', function ($row) {
                return $row->kendaraan ? $row->kendaraan->plat_no : '';
            });

            $table->editColumn('kendaraan.merk', function ($row) {
                return $row->kendaraan ? (is_string($row->kendaraan) ? $row->kendaraan : $row->kendaraan->merk) : '';
            });
            $table->editColumn('kendaraan.jenis', function ($row) {
                return $row->kendaraan ? (is_string($row->kendaraan) ? $row->kendaraan : $row->kendaraan->jenis) : '';
            });

            $table->editColumn('reason', function ($row) {
                return $row->reason ? $row->reason : '';
            });
            $table->editColumn('no_hp', function ($row) {
                return $row->no_hp ? $row->no_hp : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? PinjamKendaraan::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('borrowed_by_name', function ($row) {
                return $row->borrowed_by ? $row->borrowed_by->name : '';
            });

            $table->editColumn('borrowed_by.email', function ($row) {
                return $row->borrowed_by ? (is_string($row->borrowed_by) ? $row->borrowed_by : $row->borrowed_by->email) : '';
            });
            $table->addColumn('driver_nama', function ($row) {
                return $row->driver ? $row->driver->nama : '';
            });

            $table->editColumn('driver.no_wa', function ($row) {
                return $row->driver ? (is_string($row->driver) ? $row->driver : $row->driver->no_wa) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'kendaraan', 'borrowed_by', 'driver']);

            return $table->make(true);
        }

        return view('admin.pinjamKendaraans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pinjam_kendaraan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kendaraans = Kendaraan::pluck('plat_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pinjamKendaraans.create', compact('kendaraans'));
    }

    public function store(StorePinjamKendaraanRequest $request)
    {
        $pinjamKendaraan = PinjamKendaraan::create($request->all());

        return redirect()->route('admin.pinjam-kendaraans.index');
    }

    public function edit(PinjamKendaraan $pinjamKendaraan)
    {
        abort_if(Gate::denies('pinjam_kendaraan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kendaraans = Kendaraan::pluck('plat_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $drivers = Driver::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pinjamKendaraan->load('kendaraan', 'borrowed_by', 'processed_by', 'driver', 'created_by');

        return view('admin.pinjamKendaraans.edit', compact('drivers', 'kendaraans', 'pinjamKendaraan'));
    }

    public function update(UpdatePinjamKendaraanRequest $request, PinjamKendaraan $pinjamKendaraan)
    {
        $pinjamKendaraan->update($request->all());

        return redirect()->route('admin.pinjam-kendaraans.index');
    }

    public function show(PinjamKendaraan $pinjamKendaraan)
    {
        abort_if(Gate::denies('pinjam_kendaraan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pinjamKendaraan->load('kendaraan', 'borrowed_by', 'processed_by', 'driver', 'created_by');

        return view('admin.pinjamKendaraans.show', compact('pinjamKendaraan'));
    }

    public function destroy(PinjamKendaraan $pinjamKendaraan)
    {
        abort_if(Gate::denies('pinjam_kendaraan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pinjamKendaraan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPinjamKendaraanRequest $request)
    {
        $pinjamKendaraans = PinjamKendaraan::find(request('ids'));

        foreach ($pinjamKendaraans as $pinjamKendaraan) {
            $pinjamKendaraan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
