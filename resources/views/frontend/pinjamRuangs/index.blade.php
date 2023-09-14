@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('pinjam_ruang_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.pinjam-ruangs.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.pinjamRuang.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.pinjamRuang.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PinjamRuang">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamRuang.fields.ruang') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pinjamRuang.fields.time_start') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pinjamRuang.fields.time_end') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pinjamRuang.fields.no_hp') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pinjamRuang.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pinjamRuang.fields.surat_pengajuan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pinjamRuang.fields.borrowed_by') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pinjamRuangs as $key => $pinjamRuang)
                                    <tr data-entry-id="{{ $pinjamRuang->id }}">
                                        <td>
                                            {{ $pinjamRuang->ruang->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamRuang->time_start ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamRuang->time_end ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamRuang->no_hp ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\PinjamRuang::STATUS_SELECT[$pinjamRuang->status] ?? '' }}
                                        </td>
                                        <td>
                                            @if($pinjamRuang->surat_pengajuan)
                                                <a href="{{ $pinjamRuang->surat_pengajuan->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $pinjamRuang->borrowed_by->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('pinjam_ruang_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.pinjam-ruangs.show', $pinjamRuang->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('pinjam_ruang_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.pinjam-ruangs.edit', $pinjamRuang->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('pinjam_ruang_delete')
                                                <form action="{{ route('frontend.pinjam-ruangs.destroy', $pinjamRuang->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('pinjam_ruang_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.pinjam-ruangs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-PinjamRuang:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection