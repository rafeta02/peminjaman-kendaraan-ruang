@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('pinjam_kendaraan_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.pinjam-kendaraans.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PinjamKendaraan">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.kendaraan') }}
                                    </th>
                                    <th>
                                        Waktu Peminjaman
                                    </th>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.reason') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pinjamKendaraan.fields.status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pinjamKendaraans as $key => $pinjamKendaraan)
                                    <tr data-entry-id="{{ $pinjamKendaraan->id }}">
                                        <td>
                                            {{ $pinjamKendaraan->kendaraan->plat_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamKendaraan->kendaraan->merk ?? '' }}
                                        </td>
                                        <td>
                                            @if($pinjamKendaraan->kendaraan)
                                                {{ $pinjamKendaraan->kendaraan::JENIS_SELECT[$pinjamKendaraan->kendaraan->jenis] ?? '' }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $pinjamKendaraan->date_start ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamKendaraan->date_end ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamKendaraan->reason ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamKendaraan->no_hp ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\PinjamKendaraan::STATUS_SELECT[$pinjamKendaraan->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamKendaraan->borrowed_by->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamKendaraan->borrowed_by->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamKendaraan->driver->nama ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamKendaraan->driver->no_wa ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pinjamKendaraan->date_return ?? '' }}
                                        </td>
                                        <td>
                                            @can('pinjam_kendaraan_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.pinjam-kendaraans.show', $pinjamKendaraan->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('pinjam_kendaraan_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.pinjam-kendaraans.edit', $pinjamKendaraan->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('pinjam_kendaraan_delete')
                                                <form action="{{ route('frontend.pinjam-kendaraans.destroy', $pinjamKendaraan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('pinjam_kendaraan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.pinjam-kendaraans.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 3, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-PinjamKendaraan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
