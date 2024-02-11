<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeRequest extends FormRequest
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
            'departement_id' => 'required',
            'prenom' => 'required|string',
            'nom' => 'required|string',
            'email' => 'required',
            'telephone' => 'required',
            'montant_journalier' => 'required|max:2500',
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'L\'Adresse Email est requis.',
            'telephone.required' => 'Le Numéro de téléphone est requis.',
            'prenom.required' => 'Le Prénom est requis.',
            'nom.required' => 'Le Nom est requis.',
            'telephone.required' => 'Le Numéro de téléphone est requis.',
            'montant_journalier.required' => 'Le Montant Journalier est requis.',
        ];
    }
}
