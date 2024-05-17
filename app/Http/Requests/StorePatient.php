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
            'dni'=>'required|digits:8|regex:/^[0-9]{8}$/|unique:patients,dni',
            'names'=>'required|max:25',
            'surnames'=>'required|max:25',
            'phone'=>'required|digits:9|regex:/^[0-9]{9}$/|unique:patients,phone',
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

    public function messages(){
        return[
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos numericos.',
            'dni.regex' => 'El DNI es incorrecto.',
            'phone.digits' => 'El celular debe tener exactamente 9 dígitos.',
            'phone.regex' => 'El celular es incorrecto.'
        ];
    } 
}
