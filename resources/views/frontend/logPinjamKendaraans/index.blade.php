@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.logPinjamKendaraan.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-LogPinjamKendaraan">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($logPinjamKendaraans as $key => $logPinjamKendaraan)
                                    <tr data-entry-id="{{ $logPinjamKendaraan->id }}">
                                        <td>
                                            {{ $logPinjamKendaraan->peminjaman->reason ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPinjamKendaraan->peminjaman->reason ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPinjamKendaraan->kendaraan->plat_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPinjamKendaraan->kendaraan->merk ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPinjamKendaraan->peminjam->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\LogPinjamKendaraan::JENIS_SELECT[$logPinjamKendaraan->jenis] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logPinjamKendaraan->log ?? '' }}
                                        </td>
                                        <td>
                                            @can('log_pinjam_kendaraan_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.log-pinjam-kendaraans.show', $logPinjamKendaraan->id) }}">
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
  let table = $('.datatable-LogPinjamKendaraan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection