@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.ruang.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Ruang">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($ruangs as $key => $ruang)
                                    <tr data-entry-id="{{ $ruang->id }}">
                                        <td>
                                            {{ $ruang->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ruang->lantai->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ruang->kapasitas ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ruang->fasilitas ?? '' }}
                                        </td>
                                        <td>
                                            @can('ruang_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.ruangs.show', $ruang->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('ruang_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.ruangs.edit', $ruang->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('ruang_delete')
                                                <form action="{{ route('frontend.ruangs.destroy', $ruang->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-Ruang:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
