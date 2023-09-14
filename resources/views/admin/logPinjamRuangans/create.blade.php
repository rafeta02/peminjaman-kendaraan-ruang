@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.logPinjamRuangan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.log-pinjam-ruangans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="peminjaman_id">{{ trans('cruds.logPinjamRuangan.fields.peminjaman') }}</label>
                <select class="form-control select2 {{ $errors->has('peminjaman') ? 'is-invalid' : '' }}" name="peminjaman_id" id="peminjaman_id" required>
                    @foreach($peminjamen as $id => $entry)
                        <option value="{{ $id }}" {{ old('peminjaman_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('peminjaman'))
                    <span class="text-danger">{{ $errors->first('peminjaman') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logPinjamRuangan.fields.peminjaman_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ruang_id">{{ trans('cruds.logPinjamRuangan.fields.ruang') }}</label>
                <select class="form-control select2 {{ $errors->has('ruang') ? 'is-invalid' : '' }}" name="ruang_id" id="ruang_id" required>
                    @foreach($ruangs as $id => $entry)
                        <option value="{{ $id }}" {{ old('ruang_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ruang'))
                    <span class="text-danger">{{ $errors->first('ruang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logPinjamRuangan.fields.ruang_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.logPinjamRuangan.fields.jenis') }}</label>
                <select class="form-control {{ $errors->has('jenis') ? 'is-invalid' : '' }}" name="jenis" id="jenis" required>
                    <option value disabled {{ old('jenis', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\LogPinjamRuangan::JENIS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('jenis', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis'))
                    <span class="text-danger">{{ $errors->first('jenis') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logPinjamRuangan.fields.jenis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="log">{{ trans('cruds.logPinjamRuangan.fields.log') }}</label>
                <textarea class="form-control {{ $errors->has('log') ? 'is-invalid' : '' }}" name="log" id="log">{{ old('log') }}</textarea>
                @if($errors->has('log'))
                    <span class="text-danger">{{ $errors->first('log') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logPinjamRuangan.fields.log_helper') }}</span>
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