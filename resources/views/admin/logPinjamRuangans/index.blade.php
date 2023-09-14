@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.logPinjamRuangan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-LogPinjamRuangan">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.logPinjamRuangan.fields.peminjaman') }}
                    </th>
                    <th>
                        {{ trans('cruds.logPinjamRuangan.fields.ruang') }}
                    </th>
                    <th>
                        {{ trans('cruds.logPinjamRuangan.fields.jenis') }}
                    </th>
                    <th>
                        {{ trans('cruds.logPinjamRuangan.fields.log') }}
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
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.log-pinjam-ruangans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'peminjaman_penggunaan', name: 'peminjaman.penggunaan' },
{ data: 'ruang_name', name: 'ruang.name' },
{ data: 'jenis', name: 'jenis' },
{ data: 'log', name: 'log' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-LogPinjamRuangan').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection