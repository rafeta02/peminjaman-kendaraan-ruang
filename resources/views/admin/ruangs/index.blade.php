@extends('layouts.admin')
@section('content')
@can('ruang_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.ruangs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.ruang.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Ruang', 'route' => 'admin.ruangs.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.ruang.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Ruang">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.ruang.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.ruang.fields.lantai') }}
                    </th>
                    <th>
                        {{ trans('cruds.ruang.fields.kapasitas') }}
                    </th>
                    <th>
                        {{ trans('cruds.ruang.fields.fasilitas') }}
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
    ajax: "{{ route('admin.ruangs.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'name', name: 'name', class: 'text-center' },
        { data: 'lantai_name', name: 'lantai.name', class: 'text-center' },
        { data: 'kapasitas', name: 'kapasitas', class: 'text-center' },
        { data: 'fasilitas', name: 'fasilitas' },
        { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Ruang').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
