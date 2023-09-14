<?php

namespace App\Http\Controllers\Frontend;

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

class PinjamKendaraanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pinjam_kendaraan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pinjamKendaraans = PinjamKendaraan::with(['kendaraan', 'borrowed_by', 'processed_by', 'driver', 'created_by'])->get();

        return view('frontend.pinjamKendaraans.index', compact('pinjamKendaraans'));
    }

    public function create()
    {
        abort_if(Gate::denies('pinjam_kendaraan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kendaraans = Kendaraan::pluck('plat_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.pinjamKendaraans.create', compact('kendaraans'));
    }

    public function store(StorePinjamKendaraanRequest $request)
    {
        $pinjamKendaraan = PinjamKendaraan::create($request->all());

        return redirect()->route('frontend.pinjam-kendaraans.index');
    }

    public function edit(PinjamKendaraan $pinjamKendaraan)
    {
        abort_if(Gate::denies('pinjam_kendaraan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kendaraans = Kendaraan::pluck('plat_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $drivers = Driver::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pinjamKendaraan->load('kendaraan', 'borrowed_by', 'processed_by', 'driver', 'created_by');

        return view('frontend.pinjamKendaraans.edit', compact('drivers', 'kendaraans', 'pinjamKendaraan'));
    }

    public function update(UpdatePinjamKendaraanRequest $request, PinjamKendaraan $pinjamKendaraan)
    {
        $pinjamKendaraan->update($request->all());

        return redirect()->route('frontend.pinjam-kendaraans.index');
    }

    public function show(PinjamKendaraan $pinjamKendaraan)
    {
        abort_if(Gate::denies('pinjam_kendaraan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pinjamKendaraan->load('kendaraan', 'borrowed_by', 'processed_by', 'driver', 'created_by');

        return view('frontend.pinjamKendaraans.show', compact('pinjamKendaraan'));
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
