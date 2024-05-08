<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAssignmentUserSpecialization extends FormRequest
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
     * @param
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_doctor'=>'required',
            'id_specialization' => 'required',
            'vaucher_specialization'=>'required|numeric|max:'.$this->input('max_voucher')
        ];
    }

    public function attributes()
    {
        return[
            'id_doctor'=>'nombre del Doctor',
            'id_specialization'=>'especialidad',
            'vaucher_specialization'=>'cupos'
        ];
    }
}
