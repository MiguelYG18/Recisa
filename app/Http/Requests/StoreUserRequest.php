<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'dni'=>'required|digits:8|regex:/^[0-9]{8}$/|unique:users,dni',
            'names'=>'required|max:25',
            'surnames'=>'required|max:25',
            'phone'=>'required|digits:9|regex:/^[0-9]{9}$/|unique:users,phone',
            'email'=>'required|email|max:255|unique:users,email',
            'password'=>'required|min:8|min:8|same:password_confirm',
            'user_level'=>'required|integer|exists:user_groups,group_level',
            'status'=>'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2000'
        ];
    }
    public function attributes(){
        return[
            'names'=>'nombres',
            'surnames'=>'apellidos',
            'user_level'=>'nivel de usuario',
            'status'=>'estado',
            'password_confirm'=>'confirmar password'
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
