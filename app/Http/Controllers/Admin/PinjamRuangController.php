<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPinjamRuangRequest;
use App\Http\Requests\StorePinjamRuangRequest;
use App\Http\Requests\UpdatePinjamRuangRequest;
use App\Models\PinjamRuang;
use App\Models\Ruang;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PinjamRuangController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pinjam_ruang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PinjamRuang::with(['ruang', 'borrowed_by', 'processed_by', 'created_by'])->select(sprintf('%s.*', (new PinjamRuang)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'pinjam_ruang_show';
                $editGate      = 'pinjam_ruang_edit';
                $deleteGate    = 'pinjam_ruang_delete';
                $crudRoutePart = 'pinjam-ruangs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('ruang_name', function ($row) {
                return $row->ruang ? $row->ruang->name : '';
            });

            $table->editColumn('no_hp', function ($row) {
                return $row->no_hp ? $row->no_hp : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? PinjamRuang::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('surat_pengajuan', function ($row) {
                return $row->surat_pengajuan ? '<a href="' . $row->surat_pengajuan->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->addColumn('borrowed_by_name', function ($row) {
                return $row->borrowed_by ? $row->borrowed_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'ruang', 'surat_pengajuan', 'borrowed_by']);

            return $table->make(true);
        }

        return view('admin.pinjamRuangs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pinjam_ruang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ruangs = Ruang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $borrowed_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pinjamRuangs.create', compact('borrowed_bies', 'ruangs'));
    }

    public function store(StorePinjamRuangRequest $request)
    {
        $pinjamRuang = PinjamRuang::create($request->all());

        if ($request->input('surat_pengajuan', false)) {
            $pinjamRuang->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_pengajuan'))))->toMediaCollection('surat_pengajuan');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pinjamRuang->id]);
        }

        return redirect()->route('admin.pinjam-ruangs.index');
    }

    public function edit(PinjamRuang $pinjamRuang)
    {
        abort_if(Gate::denies('pinjam_ruang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ruangs = Ruang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $borrowed_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pinjamRuang->load('ruang', 'borrowed_by', 'processed_by', 'created_by');

        return view('admin.pinjamRuangs.edit', compact('borrowed_bies', 'pinjamRuang', 'ruangs'));
    }

    public function update(UpdatePinjamRuangRequest $request, PinjamRuang $pinjamRuang)
    {
        $pinjamRuang->update($request->all());

        if ($request->input('surat_pengajuan', false)) {
            if (! $pinjamRuang->surat_pengajuan || $request->input('surat_pengajuan') !== $pinjamRuang->surat_pengajuan->file_name) {
                if ($pinjamRuang->surat_pengajuan) {
                    $pinjamRuang->surat_pengajuan->delete();
                }
                $pinjamRuang->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_pengajuan'))))->toMediaCollection('surat_pengajuan');
            }
        } elseif ($pinjamRuang->surat_pengajuan) {
            $pinjamRuang->surat_pengajuan->delete();
        }

        return redirect()->route('admin.pinjam-ruangs.index');
    }

    public function show(PinjamRuang $pinjamRuang)
    {
        abort_if(Gate::denies('pinjam_ruang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pinjamRuang->load('ruang', 'borrowed_by', 'processed_by', 'created_by');

        return view('admin.pinjamRuangs.show', compact('pinjamRuang'));
    }

    public function destroy(PinjamRuang $pinjamRuang)
    {
        abort_if(Gate::denies('pinjam_ruang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pinjamRuang->delete();

        return back();
    }

    public function massDestroy(MassDestroyPinjamRuangRequest $request)
    {
        $pinjamRuangs = PinjamRuang::find(request('ids'));

        foreach ($pinjamRuangs as $pinjamRuang) {
            $pinjamRuang->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pinjam_ruang_create') && Gate::denies('pinjam_ruang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PinjamRuang();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
