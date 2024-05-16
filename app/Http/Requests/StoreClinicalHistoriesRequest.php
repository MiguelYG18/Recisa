<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClinicalHistoriesRequest extends FormRequest
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
            'history_number'=>'required|max:25',
            'source_pdf'=>'nullable|source_pdf|mimes:pdf|max:10000'
        ];
    }

    public function attributes()
    {
        return[
            'history_number'=>'número de historial'
        ];
    }
}
