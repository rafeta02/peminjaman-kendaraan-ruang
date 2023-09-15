<?php

namespace App\Http\Requests;

use App\Models\LogPinjamKendaraan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLogPinjamKendaraanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('log_pinjam_kendaraan_edit');
    }

    public function rules()
    {
        return [
            'peminjaman_id' => [
                'required',
                'integer',
            ],
            'kendaraan_id' => [
                'required',
                'integer',
            ],
            'peminjam_id' => [
                'required',
                'integer',
            ],
            'jenis' => [
                'required',
            ],
        ];
    }
}
