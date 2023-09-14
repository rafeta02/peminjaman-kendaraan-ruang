<?php

namespace App\Http\Requests;

use App\Models\PinjamRuang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPinjamRuangRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pinjam_ruang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pinjam_ruangs,id',
        ];
    }
}
