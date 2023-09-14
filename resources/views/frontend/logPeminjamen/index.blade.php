@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.logPeminjaman.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-LogPeminjaman">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logPeminjaman.fields.peminjaman') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.reason') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logPeminjaman.fields.kendaraan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.kendaraan.fields.merk') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logPeminjaman.fields.peminjam') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logPeminjaman.fields.jenis') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logPeminjaman.fields.log') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logPeminjamen as $key => $logPeminjaman)
                                    <tr data-entry-id="{{ $logPeminjaman->id }}">
                                        <td>
                                            {{ $logPeminjaman->peminjaman->reason ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPeminjaman->peminjaman->reason ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPeminjaman->kendaraan->plat_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPeminjaman->kendaraan->merk ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPeminjaman->peminjam->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\LogPeminjaman::JENIS_SELECT[$logPeminjaman->jenis] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPeminjaman->log ?? '' }}
                                        </td>
                                        <td>
                                            @can('log_peminjaman_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.log-peminjamen.show', $logPeminjaman->id) }}">
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
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-LogPeminjaman:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection