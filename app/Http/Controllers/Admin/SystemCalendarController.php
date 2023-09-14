<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\PinjamRuang',
            'date_field' => 'time_start',
            'field'      => 'penggunaan',
            'prefix'     => 'Peminjaman Ruang digunakan untuk',
            'suffix'     => 'Dibuat',
            'route'      => 'admin.pinjam-ruangs.edit',
        ],
        [
            'model'      => '\App\Models\PinjamKendaraan',
            'date_field' => 'date_start',
            'field'      => 'reason',
            'prefix'     => 'Peminjaman Kendaraan oleh',
            'suffix'     => 'Dibuat',
            'route'      => 'admin.pinjam-kendaraans.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (! $crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
