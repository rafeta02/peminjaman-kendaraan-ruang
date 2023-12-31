@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kendaraan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kendaraans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.plat_no') }}
                        </th>
                        <td>
                            {{ $kendaraan->plat_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.slug') }}
                        </th>
                        <td>
                            {{ $kendaraan->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.merk') }}
                        </th>
                        <td>
                            {{ $kendaraan->merk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.jenis') }}
                        </th>
                        <td>
                            {{ App\Models\Kendaraan::JENIS_SELECT[$kendaraan->jenis] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.kondisi') }}
                        </th>
                        <td>
                            {{ App\Models\Kendaraan::KONDISI_SELECT[$kendaraan->kondisi] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.operasional') }}
                        </th>
                        <td>
                            {{ App\Models\Kendaraan::OPERASIONAL_SELECT[$kendaraan->operasional] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.is_used') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $kendaraan->is_used ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.unit_kerja') }}
                        </th>
                        <td>
                            {{ $kendaraan->unit_kerja->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.owned_by') }}
                        </th>
                        <td>
                            {{ $kendaraan->owned_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.servis_terakhir') }}
                        </th>
                        <td>
                            {{ $kendaraan->servis_terakhir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kendaraan.fields.foto') }}
                        </th>
                        <td>
                            @foreach($kendaraan->foto as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kendaraans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#kendaraan_pinjam_kendaraans" role="tab" data-toggle="tab">
                {{ trans('cruds.pinjamKendaraan.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="kendaraan_pinjam_kendaraans">
            @includeIf('admin.kendaraans.relationships.kendaraanPinjamKendaraans', ['pinjamKendaraans' => $kendaraan->kendaraanPinjamKendaraans])
        </div>
    </div>
</div>

@endsection