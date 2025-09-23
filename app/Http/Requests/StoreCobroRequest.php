<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCobroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $admin_cobro = $this->route()->parameter('admin_cobro');
        $rules = [
            'tipo_transaccion' => 'required',
            'cliente' => 'required',
            'ingreso' => 'required',
            'medio_pago' => 'required',
            'total_cobrado' => 'required',

        ];
        if ($admin_cobro) {
            $rules['tipo_transaccion'] = 'max:50,tipo_transaccion,' . $admin_cobro->id;
            $rules['cliente'] = 'max:50,cliente,' . $admin_cobro->id;
            $rules['ingreso'] = 'max:50,ingreso,' . $admin_cobro->id;
            $rules['medio_pago'] = 'max:50,medio_pago,' . $admin_cobro->id;
        }

        return $rules;
    }
}