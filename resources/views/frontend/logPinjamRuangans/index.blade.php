@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.logPinjamRuangan.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-LogPinjamRuangan">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($logPinjamRuangans as $key => $logPinjamRuangan)
                                    <tr data-entry-id="{{ $logPinjamRuangan->id }}">
                                        <td>
                                            {{ $logPinjamRuangan->peminjaman->penggunaan ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPinjamRuangan->ruang->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\LogPinjamRuangan::JENIS_SELECT[$logPinjamRuangan->jenis] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPinjamRuangan->log ?? '' }}
                                        </td>
                                        <td>
                                            @can('log_pinjam_ruangan_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.log-pinjam-ruangans.show', $logPinjamRuangan->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
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
  let table = $('.datatable-LogPinjamRuangan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection