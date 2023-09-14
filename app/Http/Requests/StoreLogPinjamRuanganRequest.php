<?php

namespace App\Http\Requests;

use App\Models\LogPinjamRuangan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLogPinjamRuanganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('log_pinjam_ruangan_create');
    }

    public function rules()
    {
        return [
            'peminjaman_id' => [
                'required',
                'integer',
            ],
            'ruang_id' => [
                'required',
                'integer',
            ],
            'jenis' => [
                'required',
            ],
        ];
    }
}
