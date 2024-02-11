<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeConfigurationRequest extends FormRequest
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
            'type' => 'required|unique:configurations,type',
            'valeur' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Le Type de la configuration est requis.',
            'type.unique' => 'La configuration existe déjà.',
            'valeur.required' => 'La valeur de la configuration est requis.',
        ];
    }
}
