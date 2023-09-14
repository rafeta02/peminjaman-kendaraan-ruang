@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.pinjamRuang.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.pinjam-ruangs.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="ruang_id">{{ trans('cruds.pinjamRuang.fields.ruang') }}</label>
                            <select class="form-control select2" name="ruang_id" id="ruang_id" required>
                                @foreach($ruangs as $id => $entry)
                                    <option value="{{ $id }}" {{ old('ruang_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ruang'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ruang') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamRuang.fields.ruang_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="time_start">{{ trans('cruds.pinjamRuang.fields.time_start') }}</label>
                            <input class="form-control datetime" type="text" name="time_start" id="time_start" value="{{ old('time_start') }}" required>
                            @if($errors->has('time_start'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('time_start') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamRuang.fields.time_start_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="time_end">{{ trans('cruds.pinjamRuang.fields.time_end') }}</label>
                            <input class="form-control datetime" type="text" name="time_end" id="time_end" value="{{ old('time_end') }}" required>
                            @if($errors->has('time_end'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('time_end') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamRuang.fields.time_end_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="no_hp">{{ trans('cruds.pinjamRuang.fields.no_hp') }}</label>
                            <input class="form-control" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', '') }}" required>
                            @if($errors->has('no_hp'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('no_hp') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamRuang.fields.no_hp_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="penggunaan">{{ trans('cruds.pinjamRuang.fields.penggunaan') }}</label>
                            <textarea class="form-control" name="penggunaan" id="penggunaan" required>{{ old('penggunaan') }}</textarea>
                            @if($errors->has('penggunaan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('penggunaan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamRuang.fields.penggunaan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.pinjamRuang.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\PinjamRuang::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamRuang.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="surat_pengajuan">{{ trans('cruds.pinjamRuang.fields.surat_pengajuan') }}</label>
                            <div class="needsclick dropzone" id="surat_pengajuan-dropzone">
                            </div>
                            @if($errors->has('surat_pengajuan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('surat_pengajuan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamRuang.fields.surat_pengajuan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="borrowed_by_id">{{ trans('cruds.pinjamRuang.fields.borrowed_by') }}</label>
                            <select class="form-control select2" name="borrowed_by_id" id="borrowed_by_id">
                                @foreach($borrowed_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('borrowed_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('borrowed_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('borrowed_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamRuang.fields.borrowed_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="borrowed_by_text">{{ trans('cruds.pinjamRuang.fields.borrowed_by_text') }}</label>
                            <input class="form-control" type="text" name="borrowed_by_text" id="borrowed_by_text" value="{{ old('borrowed_by_text', '') }}">
                            @if($errors->has('borrowed_by_text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('borrowed_by_text') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pinjamRuang.fields.borrowed_by_text_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.suratPengajuanDropzone = {
    url: '{{ route('frontend.pinjam-ruangs.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="surat_pengajuan"]').remove()
      $('form').append('<input type="hidden" name="surat_pengajuan" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="surat_pengajuan"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pinjamRuang) && $pinjamRuang->surat_pengajuan)
      var file = {!! json_encode($pinjamRuang->surat_pengajuan) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="surat_pengajuan" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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