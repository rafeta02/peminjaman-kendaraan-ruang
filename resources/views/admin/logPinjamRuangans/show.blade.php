@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.logPinjamRuangan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.log-pinjam-ruangans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.logPinjamRuangan.fields.peminjaman') }}
                        </th>
                        <td>
                            {{ $logPinjamRuangan->peminjaman->penggunaan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.logPinjamRuangan.fields.ruang') }}
                        </th>
                        <td>
                            {{ $logPinjamRuangan->ruang->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.logPinjamRuangan.fields.jenis') }}
                        </th>
                        <td>
                            {{ App\Models\LogPinjamRuangan::JENIS_SELECT[$logPinjamRuangan->jenis] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.logPinjamRuangan.fields.log') }}
                        </th>
                        <td>
                            {{ $logPinjamRuangan->log }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.log-pinjam-ruangans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection