@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.pinjamKendaraan.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.pinjam-kendaraans.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="kendaraan_id">{{ trans('cruds.pinjamKendaraan.fields.kendaraan') }}</label>
                            <select class="form-control select2" name="kendaraan_id" id="kendaraan_id" required>
                                @foreach($kendaraans as $id => $entry)
                                    <option value="{{ $id }}" {{ old('kendaraan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('kendaraan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kendaraan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.kendaraan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date_start">{{ trans('cruds.pinjamKendaraan.fields.date_start') }}</label>
                            <input class="form-control datetime" type="text" name="date_start" id="date_start" value="{{ old('date_start') }}" required>
                            @if($errors->has('date_start'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_start') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.date_start_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date_end">{{ trans('cruds.pinjamKendaraan.fields.date_end') }}</label>
                            <input class="form-control datetime" type="text" name="date_end" id="date_end" value="{{ old('date_end') }}" required>
                            @if($errors->has('date_end'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_end') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.date_end_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="reason">{{ trans('cruds.pinjamKendaraan.fields.reason') }}</label>
                            <input class="form-control" type="text" name="reason" id="reason" value="{{ old('reason', '') }}" required>
                            @if($errors->has('reason'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reason') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.reason_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="no_hp">{{ trans('cruds.pinjamKendaraan.fields.no_hp') }}</label>
                            <input class="form-control" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', '') }}" required>
                            @if($errors->has('no_hp'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('no_hp') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamKendaraan.fields.no_hp_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.pinjamKendaraan.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\PinjamKendaraan::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', 'diajukan') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection