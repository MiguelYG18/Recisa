<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecializationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_insert'=>'required|max:30|unique:specializations,name',
            'quantity_voucher_insert'=>'required',
        ];
    }
    public function attributes(){
        return[
            'name_insert'=>'nombre',
            'quantity_voucher_insert'=>'cupos'
        ];
    }
}
