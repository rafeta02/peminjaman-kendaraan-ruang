<?php

namespace App\Http\Requests;

use App\Models\PinjamKendaraan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPinjamKendaraanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pinjam_kendaraan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pinjam_kendaraans,id',
        ];
    }
}
