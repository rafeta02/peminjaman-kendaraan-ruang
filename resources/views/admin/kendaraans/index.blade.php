@extends('layouts.admin')
@section('content')
@can('kendaraan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kendaraans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.kendaraan.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Kendaraan', 'route' => 'admin.kendaraans.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.kendaraan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Kendaraan">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.kendaraan.fields.plat_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.kendaraan.fields.merk') }}
                    </th>
                    <th>
                        {{ trans('cruds.kendaraan.fields.jenis') }}
                    </th>
                    <th>
                        {{ trans('cruds.kendaraan.fields.operasional') }}
                    </th>
                    <th>
                        {{ trans('cruds.kendaraan.fields.unit_kerja') }}
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
    ajax: "{{ route('admin.kendaraans.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'plat_no', name: 'plat_no', class: 'text-center' },
        { data: 'merk', name: 'merk', class: 'text-center' },
        { data: 'jenis', name: 'jenis', class: 'text-center' },
        { data: 'operasional', name: 'operasional', class: 'text-center' },
        { data: 'unit_kerja_nama', name: 'unit_kerja.nama' },
        { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Kendaraan').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
