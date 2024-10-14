@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.kendaraan.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Kendaraan">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        {{ trans('cruds.kendaraan.fields.plat_no') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.kendaraan.fields.jenis') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.kendaraan.fields.merk') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.kendaraan.fields.operasional') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.kendaraan.fields.unit_kerja') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kendaraans as $key => $kendaraan)
                                    <tr data-entry-id="{{ $kendaraan->id }}">
                                        <td class="text-center">
                                            {{ $kendaraan->no_pol ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\Kendaraan::JENIS_SELECT[$kendaraan->jenis] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $kendaraan->merk ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\Kendaraan::OPERASIONAL_SELECT[$kendaraan->operasional] ?? '' }}<br>
                                            @if ($kendaraan->operasional == 'pimpinan')
                                                <u>{{ $kendaraan->owned_by->name ?? '' }}</u><br>
                                            @endif
                                            ({{ $kendaraan->unit_kerja->nama ?? '' }})
                                        </td>
                                        <td class="text-center">
                                            @if ($kendaraan->peminjaman->count() > 0)
                                                <ul>
                                                    @foreach ($kendaraan->peminjaman as $peminjaman)
                                                        <li>
                                                            <span class="text-left badge badge-{{ App\Models\Pinjam::STATUS_BACKGROUND[$peminjaman->status] ?? '' }}"> Peminjaman oleh "{{ $peminjaman->borrowed_by->name ?? '' }}" <br> Untuk tanggal {{ $peminjaman->waktu_peminjaman }} <br> Status : {{ App\Models\Pinjam::STATUS_SELECT[$peminjaman->status] ?? '' }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                {{-- <span class="text-left badge badge-{{ App\Models\Pinjam::STATUS_BACKGROUND[$kendaraan->peminjaman->status] ?? '' }}"> Peminjaman oleh "{{ $kendaraan->peminjaman->borrowed_by->name }}"<br> Status : {{ App\Models\Pinjam::STATUS_SELECT[$kendaraan->peminjaman->status] ?? '' }}</span> --}}
                                            @else
                                                <span class="badge badge-success">Tersedia</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(count($kendaraan->foto) > 0)
                                                <button class="btn btn-sm btn-info btn-block btn-view-image" data-id="{{ $kendaraan->id }}">View Image</button>
                                            @endif
                                            <button class="btn btn-sm btn-primary btn-block btn-detail" data-id="{{ $kendaraan->id }}">Detail</button>
                                            <a class="btn btn-sm btn-block btn-success btn-block" href="{{ route('frontend.pinjam-kendaraans.create', ['kendaraan' => $kendaraan->id]) }}">
                                                Ajukan
                                            </a>
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
  let table = $('.datatable-Kendaraan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
