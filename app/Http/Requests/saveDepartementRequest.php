<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveDepartementRequest extends FormRequest
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
            'nom_departement' => 'required|unique:departements,nom_departement',
        ];

    }
        public function messages()
        {
            return [
                'nom_departement.required' => 'Le Nom du Département est requis.',
                'nom_departement.unique' => 'Le Nom du Département exite déjà.',
            ];
        }
    }

