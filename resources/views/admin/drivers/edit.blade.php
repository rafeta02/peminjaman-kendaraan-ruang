@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.driver.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.drivers.update", [$driver->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nip">{{ trans('cruds.driver.fields.nip') }}</label>
                <input class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="text" name="nip" id="nip" value="{{ old('nip', $driver->nip) }}" required>
                @if($errors->has('nip'))
                    <span class="text-danger">{{ $errors->first('nip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.driver.fields.nip_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama">{{ trans('cruds.driver.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $driver->nama) }}" required>
                @if($errors->has('nama'))
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.driver.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_wa">{{ trans('cruds.driver.fields.no_wa') }}</label>
                <input class="form-control {{ $errors->has('no_wa') ? 'is-invalid' : '' }}" type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', $driver->no_wa) }}" required>
                @if($errors->has('no_wa'))
                    <span class="text-danger">{{ $errors->first('no_wa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.driver.fields.no_wa_helper') }}</span>
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