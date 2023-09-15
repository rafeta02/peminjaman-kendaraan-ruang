@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kendaraan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kendaraans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="plat_no">{{ trans('cruds.kendaraan.fields.plat_no') }}</label>
                <input class="form-control {{ $errors->has('plat_no') ? 'is-invalid' : '' }}" type="text" name="plat_no" id="plat_no" value="{{ old('plat_no', '') }}" required>
                @if($errors->has('plat_no'))
                    <span class="text-danger">{{ $errors->first('plat_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.plat_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slug">{{ trans('cruds.kendaraan.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                @if($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.slug_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="merk">{{ trans('cruds.kendaraan.fields.merk') }}</label>
                <input class="form-control {{ $errors->has('merk') ? 'is-invalid' : '' }}" type="text" name="merk" id="merk" value="{{ old('merk', '') }}" required>
                @if($errors->has('merk'))
                    <span class="text-danger">{{ $errors->first('merk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.merk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.kendaraan.fields.jenis') }}</label>
                <select class="form-control {{ $errors->has('jenis') ? 'is-invalid' : '' }}" name="jenis" id="jenis" required>
                    <option value disabled {{ old('jenis', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Kendaraan::JENIS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('jenis', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis'))
                    <span class="text-danger">{{ $errors->first('jenis') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.jenis_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.kendaraan.fields.kondisi') }}</label>
                <select class="form-control {{ $errors->has('kondisi') ? 'is-invalid' : '' }}" name="kondisi" id="kondisi" required>
                    <option value disabled {{ old('kondisi', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Kendaraan::KONDISI_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('kondisi', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('kondisi'))
                    <span class="text-danger">{{ $errors->first('kondisi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.kondisi_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.kendaraan.fields.operasional') }}</label>
                <select class="form-control {{ $errors->has('operasional') ? 'is-invalid' : '' }}" name="operasional" id="operasional">
                    <option value disabled {{ old('operasional', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Kendaraan::OPERASIONAL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('operasional', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('operasional'))
                    <span class="text-danger">{{ $errors->first('operasional') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.operasional_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="unit_kerja_id">{{ trans('cruds.kendaraan.fields.unit_kerja') }}</label>
                <select class="form-control select2 {{ $errors->has('unit_kerja') ? 'is-invalid' : '' }}" name="unit_kerja_id" id="unit_kerja_id">
                    @foreach($unit_kerjas as $id => $entry)
                        <option value="{{ $id }}" {{ old('unit_kerja_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit_kerja'))
                    <span class="text-danger">{{ $errors->first('unit_kerja') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.unit_kerja_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="owned_by_id">{{ trans('cruds.kendaraan.fields.owned_by') }}</label>
                <select class="form-control select2 {{ $errors->has('owned_by') ? 'is-invalid' : '' }}" name="owned_by_id" id="owned_by_id">
                    @foreach($owned_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('owned_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('owned_by'))
                    <span class="text-danger">{{ $errors->first('owned_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.owned_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="servis_terakhir">{{ trans('cruds.kendaraan.fields.servis_terakhir') }}</label>
                <input class="form-control date {{ $errors->has('servis_terakhir') ? 'is-invalid' : '' }}" type="text" name="servis_terakhir" id="servis_terakhir" value="{{ old('servis_terakhir') }}">
                @if($errors->has('servis_terakhir'))
                    <span class="text-danger">{{ $errors->first('servis_terakhir') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.servis_terakhir_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="foto">{{ trans('cruds.kendaraan.fields.foto') }}</label>
                <div class="needsclick dropzone {{ $errors->has('foto') ? 'is-invalid' : '' }}" id="foto-dropzone">
                </div>
                @if($errors->has('foto'))
                    <span class="text-danger">{{ $errors->first('foto') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.foto_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedFotoMap = {}
Dropzone.options.fotoDropzone = {
    url: '{{ route('admin.kendaraans.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="foto[]" value="' + response.name + '">')
      uploadedFotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFotoMap[file.name]
      }
      $('form').find('input[name="foto[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($kendaraan) && $kendaraan->foto)
      var files = {!! json_encode($kendaraan->foto) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="foto[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection