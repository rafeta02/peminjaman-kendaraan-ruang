@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.logPinjamKendaraan.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.log-pinjam-kendaraans.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logPinjamKendaraan.fields.peminjaman') }}
                                    </th>
                                    <td>
                                        {{ $logPinjamKendaraan->peminjaman->reason ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logPinjamKendaraan.fields.kendaraan') }}
                                    </th>
                                    <td>
                                        {{ $logPinjamKendaraan->kendaraan->plat_no ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logPinjamKendaraan.fields.peminjam') }}
                                    </th>
                                    <td>
                                        {{ $logPinjamKendaraan->peminjam->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logPinjamKendaraan.fields.jenis') }}
                                    </th>
                                    <td>
                                        {{ App\Models\LogPinjamKendaraan::JENIS_SELECT[$logPinjamKendaraan->jenis] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logPinjamKendaraan.fields.log') }}
                                    </th>
                                    <td>
                                        {{ $logPinjamKendaraan->log }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.log-pinjam-kendaraans.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection