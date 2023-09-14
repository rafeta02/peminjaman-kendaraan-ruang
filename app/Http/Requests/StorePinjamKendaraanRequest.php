<?php

namespace App\Http\Requests;

use App\Models\PinjamKendaraan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePinjamKendaraanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pinjam_kendaraan_create');
    }

    public function rules()
    {
        return [
            'kendaraan_id' => [
                'required',
                'integer',
            ],
            'date_start' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'date_end' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'reason' => [
                'string',
                'required',
            ],
            'no_hp' => [
                'string',
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
