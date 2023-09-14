@extends('layouts.admin')
@section('content')
@can('pinjam_ruang_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pinjam-ruangs.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PinjamRuang">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('pinjam_ruang_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pinjam-ruangs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.pinjam-ruangs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'ruang_name', name: 'ruang.name' },
{ data: 'time_start', name: 'time_start' },
{ data: 'time_end', name: 'time_end' },
{ data: 'no_hp', name: 'no_hp' },
{ data: 'status', name: 'status' },
{ data: 'surat_pengajuan', name: 'surat_pengajuan', sortable: false, searchable: false },
{ data: 'borrowed_by_name', name: 'borrowed_by.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-PinjamRuang').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection