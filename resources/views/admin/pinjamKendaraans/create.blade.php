@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pinjamKendaraan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pinjam-kendaraans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="kendaraan_id">{{ trans('cruds.pinjamKendaraan.fields.kendaraan') }}</label>
                <select class="form-control select2 {{ $errors->has('kendaraan') ? 'is-invalid' : '' }}" name="kendaraan_id" id="kendaraan_id" required>
                    @foreach($kendaraans as $id => $entry)
                        <option value="{{ $id }}" {{ old('kendaraan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kendaraan'))
                    <span class="text-danger">{{ $errors->first('kendaraan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.kendaraan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_start">{{ trans('cruds.pinjamKendaraan.fields.date_start') }}</label>
                <input class="form-control datetime {{ $errors->has('date_start') ? 'is-invalid' : '' }}" type="text" name="date_start" id="date_start" value="{{ old('date_start') }}" required>
                @if($errors->has('date_start'))
                    <span class="text-danger">{{ $errors->first('date_start') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.date_start_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_end">{{ trans('cruds.pinjamKendaraan.fields.date_end') }}</label>
                <input class="form-control datetime {{ $errors->has('date_end') ? 'is-invalid' : '' }}" type="text" name="date_end" id="date_end" value="{{ old('date_end') }}" required>
                @if($errors->has('date_end'))
                    <span class="text-danger">{{ $errors->first('date_end') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.date_end_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="reason">{{ trans('cruds.pinjamKendaraan.fields.reason') }}</label>
                <input class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" type="text" name="reason" id="reason" value="{{ old('reason', '') }}" required>
                @if($errors->has('reason'))
                    <span class="text-danger">{{ $errors->first('reason') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.reason_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_hp">{{ trans('cruds.pinjamKendaraan.fields.no_hp') }}</label>
                <input class="form-control {{ $errors->has('no_hp') ? 'is-invalid' : '' }}" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', '') }}" required>
                @if($errors->has('no_hp'))
                    <span class="text-danger">{{ $errors->first('no_hp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.no_hp_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.pinjamKendaraan.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PinjamKendaraan::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'diajukan') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection