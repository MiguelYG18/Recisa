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
            'history_number' => 'required|regex:/^[0-9]{10}$/|unique:clinical_histories,history_number',
            'files' => 'required|array',
            'files.*' => 'file|mimes:pdf|max:2000',
        ];
    }

    public function attributes()
    {
        return [
            'history_number' => 'número de historial',
            'files' => 'archivos',
            'files.*' => 'cada archivo'
        ];
    }
}
