<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeRequest extends FormRequest
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
            'departement_id' => 'required|integer',
            'prenom' => 'required|string',
            'nom' => 'required|string',
            'email' => 'required|unique:employes,email',
            'telephone' => 'required|unique:employes,telephone',
            'montant_journalier' => 'required|max:2500',
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'L\'Adresse Email est requis.',
            'email.unique' => 'L\'Adresse Email exite déjà.',
            'telephone.required' => 'Le Numéro de téléphone est requis.',
            'telephone.unique' => 'Le Numéro de téléphone exite déjà.',
        ];
    }
}
