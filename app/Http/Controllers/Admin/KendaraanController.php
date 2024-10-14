<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyKendaraanRequest;
use App\Http\Requests\StoreKendaraanRequest;
use App\Http\Requests\UpdateKendaraanRequest;
use App\Models\Kendaraan;
use App\Models\SubUnit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KendaraanController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('kendaraan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Kendaraan::with(['unit_kerja', 'owned_by'])->select(sprintf('%s.*', (new Kendaraan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'kendaraan_show';
                $editGate      = 'kendaraan_edit';
                $deleteGate    = 'kendaraan_delete';
                $crudRoutePart = 'kendaraans';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('plat_no', function ($row) {
                return $row->plat_no ? $row->plat_no : '';
            });
            $table->editColumn('merk', function ($row) {
                return $row->merk ? $row->merk : '';
            });
            $table->editColumn('jenis', function ($row) {
                return $row->jenis ? Kendaraan::JENIS_SELECT[$row->jenis] : '';
            });
            $table->editColumn('operasional', function ($row) {
                return $row->operasional ? Kendaraan::OPERASIONAL_SELECT[$row->operasional] : '';
            });
            $table->addColumn('unit_kerja_nama', function ($row) {
                return $row->unit_kerja ? $row->unit_kerja->nama : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'unit_kerja']);

            return $table->make(true);
        }

        return view('admin.kendaraans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kendaraan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit_kerjas = SubUnit::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.kendaraans.create', compact('owned_bies', 'unit_kerjas'));
    }

    public function store(StoreKendaraanRequest $request)
    {
        $kendaraan = Kendaraan::create($request->all());

        foreach ($request->input('foto', []) as $file) {
            $kendaraan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('foto');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $kendaraan->id]);
        }

        return redirect()->route('admin.kendaraans.index');
    }

    public function edit(Kendaraan $kendaraan)
    {
        abort_if(Gate::denies('kendaraan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit_kerjas = SubUnit::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kendaraan->load('unit_kerja', 'owned_by');

        return view('admin.kendaraans.edit', compact('kendaraan', 'owned_bies', 'unit_kerjas'));
    }

    public function update(UpdateKendaraanRequest $request, Kendaraan $kendaraan)
    {
        $kendaraan->update($request->all());

        if (count($kendaraan->foto) > 0) {
            foreach ($kendaraan->foto as $media) {
                if (! in_array($media->file_name, $request->input('foto', []))) {
                    $media->delete();
                }
            }
        }
        $media = $kendaraan->foto->pluck('file_name')->toArray();
        foreach ($request->input('foto', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $kendaraan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('foto');
            }
        }

        return redirect()->route('admin.kendaraans.index');
    }

    public function show(Kendaraan $kendaraan)
    {
        abort_if(Gate::denies('kendaraan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kendaraan->load('unit_kerja', 'owned_by', 'kendaraanPinjamKendaraans');

        return view('admin.kendaraans.show', compact('kendaraan'));
    }

    public function destroy(Kendaraan $kendaraan)
    {
        abort_if(Gate::denies('kendaraan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kendaraan->delete();

        return back();
    }

    public function massDestroy(MassDestroyKendaraanRequest $request)
    {
        $kendaraans = Kendaraan::find(request('ids'));

        foreach ($kendaraans as $kendaraan) {
            $kendaraan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('kendaraan_create') && Gate::denies('kendaraan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Kendaraan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
