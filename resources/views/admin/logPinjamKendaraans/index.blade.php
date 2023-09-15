@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.logPinjamKendaraan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-LogPinjamKendaraan">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.logPinjamKendaraan.fields.peminjaman') }}
                    </th>
                    <th>
                        {{ trans('cruds.pinjamKendaraan.fields.reason') }}
                    </th>
                    <th>
                        {{ trans('cruds.logPinjamKendaraan.fields.kendaraan') }}
                    </th>
                    <th>
                        {{ trans('cruds.kendaraan.fields.merk') }}
                    </th>
                    <th>
                        {{ trans('cruds.logPinjamKendaraan.fields.peminjam') }}
                    </th>
                    <th>
                        {{ trans('cruds.logPinjamKendaraan.fields.jenis') }}
                    </th>
                    <th>
                        {{ trans('cruds.logPinjamKendaraan.fields.log') }}
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
    ajax: "{{ route('admin.log-pinjam-kendaraans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'peminjaman_reason', name: 'peminjaman.reason' },
{ data: 'peminjaman.reason', name: 'peminjaman.reason' },
{ data: 'kendaraan_plat_no', name: 'kendaraan.plat_no' },
{ data: 'kendaraan.merk', name: 'kendaraan.merk' },
{ data: 'peminjam_name', name: 'peminjam.name' },
{ data: 'jenis', name: 'jenis' },
{ data: 'log', name: 'log' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 3, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-LogPinjamKendaraan').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection