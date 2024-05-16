<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatient extends FormRequest
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
            'dni'=>'required|max:8|unique:patients,dni',
            'names'=>'required|max:25',
            'surnames'=>'required|max:25',
            'phone'=>'required|min:9|max:9|unique:patients,phone',
            'age'=> 'required'
        ];
    }

    public function attributes()
    {
        return[
            'names'=>'nombres',
            'surnames'=>'apellidos',
            'age'=>'edad'
        ];
    }
}
