<?php

namespace App\Http\Requests;

use App\Models\LogPinjamRuangan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLogPinjamRuanganRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('log_pinjam_ruangan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:log_pinjam_ruangans,id',
        ];
    }
}
