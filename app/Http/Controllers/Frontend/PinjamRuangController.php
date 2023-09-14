<?php

namespace App\Http\Controllers\Frontend;

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

class PinjamRuangController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pinjam_ruang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pinjamRuangs = PinjamRuang::with(['ruang', 'borrowed_by', 'processed_by', 'created_by', 'media'])->get();

        return view('frontend.pinjamRuangs.index', compact('pinjamRuangs'));
    }

    public function create()
    {
        abort_if(Gate::denies('pinjam_ruang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ruangs = Ruang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $borrowed_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.pinjamRuangs.create', compact('borrowed_bies', 'ruangs'));
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

        return redirect()->route('frontend.pinjam-ruangs.index');
    }

    public function edit(PinjamRuang $pinjamRuang)
    {
        abort_if(Gate::denies('pinjam_ruang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ruangs = Ruang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $borrowed_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pinjamRuang->load('ruang', 'borrowed_by', 'processed_by', 'created_by');

        return view('frontend.pinjamRuangs.edit', compact('borrowed_bies', 'pinjamRuang', 'ruangs'));
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

        return redirect()->route('frontend.pinjam-ruangs.index');
    }

    public function show(PinjamRuang $pinjamRuang)
    {
        abort_if(Gate::denies('pinjam_ruang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pinjamRuang->load('ruang', 'borrowed_by', 'processed_by', 'created_by');

        return view('frontend.pinjamRuangs.show', compact('pinjamRuang'));
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
