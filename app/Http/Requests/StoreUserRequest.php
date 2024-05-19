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
            'dni'=>'required|regex:/^[0-9]{8}$/|unique:users,dni',
            'names'=>'required|string|regex:/^[\pL\s]+$/u|max:25',
            'surnames'=>'required|string|regex:/^[\pL\s]+$/u|max:25',
            'phone'=>'required|regex:/^[0-9]{9}$/|unique:users,phone',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['outlook.com', 'hotmail.com','gmail.com'];
                    $domain = explode('@', $value)[1];
                    if (!in_array($domain, $allowedDomains)) {
                        $fail("El dominio del correo electrónico no está permitido.");
                    }
                },
            ],
            'password'=>'required|min:8|min:8|same:password_confirm',
            'user_level'=>'required|integer|exists:user_groups,group_level',
            'status'=>'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
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
}
