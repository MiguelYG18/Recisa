<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserGroup extends FormRequest
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
            'group_level'=>'required|unique:user_groups,group_level',
            'group_status'=>'required',
            'slug'=>'required|max:10|unique:user_groups,slug'
        ];
    }
    public function attributes(){
        return[
            'group_level'=>'nivel de grupo',
            'group_status'=>'estado',
            'slug'=>'enlace'
        ];
    }
    public function messages(){
        return[
            'slug.required'=>'El campo enlace se genera con el nivel de usuario'
        ];
    }   
}
