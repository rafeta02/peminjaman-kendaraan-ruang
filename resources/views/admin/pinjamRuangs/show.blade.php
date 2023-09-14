@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pinjamRuang.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pinjam-ruangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.ruang') }}
                        </th>
                        <td>
                            {{ $pinjamRuang->ruang->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.time_start') }}
                        </th>
                        <td>
                            {{ $pinjamRuang->time_start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.time_end') }}
                        </th>
                        <td>
                            {{ $pinjamRuang->time_end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.no_hp') }}
                        </th>
                        <td>
                            {{ $pinjamRuang->no_hp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.penggunaan') }}
                        </th>
                        <td>
                            {{ $pinjamRuang->penggunaan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PinjamRuang::STATUS_SELECT[$pinjamRuang->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.status_text') }}
                        </th>
                        <td>
                            {{ $pinjamRuang->status_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.surat_pengajuan') }}
                        </th>
                        <td>
                            @if($pinjamRuang->surat_pengajuan)
                                <a href="{{ $pinjamRuang->surat_pengajuan->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.borrowed_by') }}
                        </th>
                        <td>
                            {{ $pinjamRuang->borrowed_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.borrowed_by_text') }}
                        </th>
                        <td>
                            {{ $pinjamRuang->borrowed_by_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pinjamRuang.fields.processed_by') }}
                        </th>
                        <td>
                            {{ $pinjamRuang->processed_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pinjam-ruangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection