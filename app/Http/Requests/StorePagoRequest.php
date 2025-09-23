<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest
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
        $admin_pago = $this->route()->parameter('admin_pago');
        $rules = [
            'tipo_transaccion' => 'required',
            'egreso' => 'required',
            'medio_pago' => 'required',
            'total_pagado' => 'required',

        ];
        if ($admin_pago) {
            $rules['tipo_transaccion'] = 'max:50,tipo_transaccion,' . $admin_pago->id;
            $rules['egreso'] = 'max:50,egreso,' . $admin_pago->id;
            $rules['medio_pago'] = 'max:50,medio_pago,' . $admin_pago->id;
        }

        return $rules;
    }
}