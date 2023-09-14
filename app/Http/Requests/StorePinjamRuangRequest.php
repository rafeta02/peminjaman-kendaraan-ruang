<?php

namespace App\Http\Requests;

use App\Models\PinjamRuang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePinjamRuangRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pinjam_ruang_create');
    }

    public function rules()
    {
        return [
            'ruang_id' => [
                'required',
                'integer',
            ],
            'time_start' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'time_end' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'no_hp' => [
                'string',
                'required',
            ],
            'penggunaan' => [
                'required',
            ],
            'status' => [
                'required',
            ],
            'borrowed_by_text' => [
                'string',
                'nullable',
            ],
        ];
    }
}
