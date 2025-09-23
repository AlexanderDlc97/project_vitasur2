<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCuentabancoRequest extends FormRequest
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
        $admin_cuentas_bancaria = $this->route()->parameter('admin_cuentas_bancaria');
        $rules = [
            'name' => 'required|unique:cuentasbancos',
            'nro_cuenta' => 'required|numeric',
            'nro_cuenta_cci' => 'required|numeric',
            'apertura_cuenta' => 'required',
            'tipocuenta_id' => 'required',
            'banco_id' => 'required',
        ];
        if ($admin_cuentas_bancaria) {
            $rules['name'] = 'required|unique:cuentasbancos,name,' . $admin_cuentas_bancaria->id;
            $rules['tipocuenta_id'] = 'max:50,tipocuenta_id,' . $admin_cuentas_bancaria->id;
            $rules['banco_id'] = 'max:50,banco_id,' . $admin_cuentas_bancaria->id;
        }

        return $rules;
    }
}