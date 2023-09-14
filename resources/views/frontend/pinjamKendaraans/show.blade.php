@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.pinjamKendaraan.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pinjam-kendaraans.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.kendaraan') }}
                                    </th>
                                    <td>
                                        {{ $pinjamKendaraan->kendaraan->plat_no ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.date_start') }}
                                    </th>
                                    <td>
                                        {{ $pinjamKendaraan->date_start }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.date_end') }}
                                    </th>
                                    <td>
                                        {{ $pinjamKendaraan->date_end }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.reason') }}
                                    </th>
                                    <td>
                                        {{ $pinjamKendaraan->reason }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.no_hp') }}
                                    </th>
                                    <td>
                                        {{ $pinjamKendaraan->no_hp }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PinjamKendaraan::STATUS_SELECT[$pinjamKendaraan->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.status_text') }}
                                    </th>
                                    <td>
                                        {{ $pinjamKendaraan->status_text }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.borrowed_by') }}
                                    </th>
                                    <td>
                                        {{ $pinjamKendaraan->borrowed_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.borrowed_by_text') }}
                                    </th>
                                    <td>
                                        {{ $pinjamKendaraan->borrowed_by_text }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.driver') }}
                                    </th>
                                    <td>
                                        {{ $pinjamKendaraan->driver->nama ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.date_return') }}
                                    </th>
                                    <td>
                                        {{ $pinjamKendaraan->date_return }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.is_done') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $pinjamKendaraan->is_done ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pinjam-kendaraans.index') }}">
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