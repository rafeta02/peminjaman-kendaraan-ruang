@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.satpam.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.satpams.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nip">{{ trans('cruds.satpam.fields.nip') }}</label>
                            <input class="form-control" type="text" name="nip" id="nip" value="{{ old('nip', '') }}" required>
                            @if($errors->has('nip'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nip') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.satpam.fields.nip_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.satpam.fields.nama') }}</label>
                            <input class="form-control" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.satpam.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="no_wa">{{ trans('cruds.satpam.fields.no_wa') }}</label>
                            <input class="form-control" type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', '') }}">
                            @if($errors->has('no_wa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('no_wa') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.satpam.fields.no_wa_helper') }}</span>
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