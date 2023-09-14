<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Peminjaman Kendaraan terakhir',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\PinjamKendaraan',
            'group_by_field'        => 'date_start',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
            'fields'                => [
                'kendaraan'   => 'plat_no',
                'date_start'  => '',
                'date_end'    => '',
                'reason'      => '',
                'no_hp'       => '',
                'borrowed_by' => 'name',
            ],
            'translation_key' => 'pinjamKendaraan',
        ];

        $settings1['data'] = [];
        if (class_exists($settings1['model'])) {
            $settings1['data'] = $settings1['model']::latest()
                ->take($settings1['entries_number'])
                ->get();
        }

        if (! array_key_exists('fields', $settings1)) {
            $settings1['fields'] = [];
        }

        $settings2 = [
            'chart_title'           => 'Peminjaman Ruangan Terakhir',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\PinjamRuang',
            'group_by_field'        => 'time_start',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
            'fields'                => [
                'ruang'       => 'name',
                'time_start'  => '',
                'time_end'    => '',
                'penggunaan'  => '',
                'borrowed_by' => 'name',
            ],
            'translation_key' => 'pinjamRuang',
        ];

        $settings2['data'] = [];
        if (class_exists($settings2['model'])) {
            $settings2['data'] = $settings2['model']::latest()
                ->take($settings2['entries_number'])
                ->get();
        }

        if (! array_key_exists('fields', $settings2)) {
            $settings2['fields'] = [];
        }

        $settings3 = [
            'chart_title'           => 'Jumlah Peminjaman Ruang',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\PinjamRuang',
            'group_by_field'        => 'time_start',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'translation_key'       => 'pinjamRuang',
        ];

        $chart3 = new LaravelChart($settings3);

        $settings4 = [
            'chart_title'           => 'Jumlah Peminjaman Kendaraan',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\PinjamKendaraan',
            'group_by_field'        => 'date_start',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'translation_key'       => 'pinjamKendaraan',
        ];

        $chart4 = new LaravelChart($settings4);

        $settings5 = [
            'chart_title'           => 'Jumlah Kendaraan',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Kendaraan',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'kendaraan',
        ];

        $settings5['total_number'] = 0;
        if (class_exists($settings5['model'])) {
            $settings5['total_number'] = $settings5['model']::when(isset($settings5['filter_field']), function ($query) use ($settings5) {
                if (isset($settings5['filter_days'])) {
                    return $query->where($settings5['filter_field'], '>=',
                        now()->subDays($settings5['filter_days'])->format('Y-m-d'));
                } elseif (isset($settings5['filter_period'])) {
                    switch ($settings5['filter_period']) {
                        case 'week': $start = date('Y-m-d', strtotime('last Monday'));
                        break;
                        case 'month': $start = date('Y-m') . '-01';
                        break;
                        case 'year': $start = date('Y') . '-01-01';
                        break;
                    }
                    if (isset($start)) {
                        return $query->where($settings5['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings5['aggregate_function'] ?? 'count'}($settings5['aggregate_field'] ?? '*');
        }

        $settings6 = [
            'chart_title'           => 'Jumlah Ruangan',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Ruang',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'ruang',
        ];

        $settings6['total_number'] = 0;
        if (class_exists($settings6['model'])) {
            $settings6['total_number'] = $settings6['model']::when(isset($settings6['filter_field']), function ($query) use ($settings6) {
                if (isset($settings6['filter_days'])) {
                    return $query->where($settings6['filter_field'], '>=',
                        now()->subDays($settings6['filter_days'])->format('Y-m-d'));
                } elseif (isset($settings6['filter_period'])) {
                    switch ($settings6['filter_period']) {
                        case 'week': $start = date('Y-m-d', strtotime('last Monday'));
                        break;
                        case 'month': $start = date('Y-m') . '-01';
                        break;
                        case 'year': $start = date('Y') . '-01-01';
                        break;
                    }
                    if (isset($start)) {
                        return $query->where($settings6['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings6['aggregate_function'] ?? 'count'}($settings6['aggregate_field'] ?? '*');
        }

        return view('home', compact('chart3', 'chart4', 'settings1', 'settings2', 'settings5', 'settings6'));
    }
}
