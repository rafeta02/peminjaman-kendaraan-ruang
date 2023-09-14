@extends('layouts.admin')
@section('content')
@can('pinjam_kendaraan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pinjam-kendaraans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pinjamKendaraan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.pinjamKendaraan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PinjamKendaraan">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.pinjamKendaraan.fields.kendaraan') }}
                    </th>
                    <th>
                        {{ trans('cruds.kendaraan.fields.merk') }}
                    </th>
                    <th>
                        {{ trans('cruds.kendaraan.fields.jenis') }}
                    </th>
                    <th>
                        {{ trans('cruds.pinjamKendaraan.fields.date_start') }}
                    </th>
                    <th>
                        {{ trans('cruds.pinjamKendaraan.fields.date_end') }}
                    </th>
                    <th>
                        {{ trans('cruds.pinjamKendaraan.fields.reason') }}
                    </th>
                    <th>
                        {{ trans('cruds.pinjamKendaraan.fields.no_hp') }}
                    </th>
                    <th>
                        {{ trans('cruds.pinjamKendaraan.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.pinjamKendaraan.fields.borrowed_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.pinjamKendaraan.fields.driver') }}
                    </th>
                    <th>
                        {{ trans('cruds.driver.fields.no_wa') }}
                    </th>
                    <th>
                        {{ trans('cruds.pinjamKendaraan.fields.date_return') }}
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
@can('pinjam_kendaraan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pinjam-kendaraans.massDestroy') }}",
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
    ajax: "{{ route('admin.pinjam-kendaraans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'kendaraan_plat_no', name: 'kendaraan.plat_no' },
{ data: 'kendaraan.merk', name: 'kendaraan.merk' },
{ data: 'kendaraan.jenis', name: 'kendaraan.jenis' },
{ data: 'date_start', name: 'date_start' },
{ data: 'date_end', name: 'date_end' },
{ data: 'reason', name: 'reason' },
{ data: 'no_hp', name: 'no_hp' },
{ data: 'status', name: 'status' },
{ data: 'borrowed_by_name', name: 'borrowed_by.name' },
{ data: 'borrowed_by.email', name: 'borrowed_by.email' },
{ data: 'driver_nama', name: 'driver.nama' },
{ data: 'driver.no_wa', name: 'driver.no_wa' },
{ data: 'date_return', name: 'date_return' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 4, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-PinjamKendaraan').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection