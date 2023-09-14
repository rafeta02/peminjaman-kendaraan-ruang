@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.logPeminjaman.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.log-peminjamen.update", [$logPeminjaman->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="peminjaman_id">{{ trans('cruds.logPeminjaman.fields.peminjaman') }}</label>
                <select class="form-control select2 {{ $errors->has('peminjaman') ? 'is-invalid' : '' }}" name="peminjaman_id" id="peminjaman_id" required>
                    @foreach($peminjamen as $id => $entry)
                        <option value="{{ $id }}" {{ (old('peminjaman_id') ? old('peminjaman_id') : $logPeminjaman->peminjaman->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('peminjaman'))
                    <span class="text-danger">{{ $errors->first('peminjaman') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logPeminjaman.fields.peminjaman_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kendaraan_id">{{ trans('cruds.logPeminjaman.fields.kendaraan') }}</label>
                <select class="form-control select2 {{ $errors->has('kendaraan') ? 'is-invalid' : '' }}" name="kendaraan_id" id="kendaraan_id" required>
                    @foreach($kendaraans as $id => $entry)
                        <option value="{{ $id }}" {{ (old('kendaraan_id') ? old('kendaraan_id') : $logPeminjaman->kendaraan->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kendaraan'))
                    <span class="text-danger">{{ $errors->first('kendaraan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logPeminjaman.fields.kendaraan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="peminjam_id">{{ trans('cruds.logPeminjaman.fields.peminjam') }}</label>
                <select class="form-control select2 {{ $errors->has('peminjam') ? 'is-invalid' : '' }}" name="peminjam_id" id="peminjam_id" required>
                    @foreach($peminjams as $id => $entry)
                        <option value="{{ $id }}" {{ (old('peminjam_id') ? old('peminjam_id') : $logPeminjaman->peminjam->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('peminjam'))
                    <span class="text-danger">{{ $errors->first('peminjam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logPeminjaman.fields.peminjam_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.logPeminjaman.fields.jenis') }}</label>
                <select class="form-control {{ $errors->has('jenis') ? 'is-invalid' : '' }}" name="jenis" id="jenis" required>
                    <option value disabled {{ old('jenis', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\LogPeminjaman::JENIS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('jenis', $logPeminjaman->jenis) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis'))
                    <span class="text-danger">{{ $errors->first('jenis') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logPeminjaman.fields.jenis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="log">{{ trans('cruds.logPeminjaman.fields.log') }}</label>
                <textarea class="form-control {{ $errors->has('log') ? 'is-invalid' : '' }}" name="log" id="log">{{ old('log', $logPeminjaman->log) }}</textarea>
                @if($errors->has('log'))
                    <span class="text-danger">{{ $errors->first('log') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logPeminjaman.fields.log_helper') }}</span>
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