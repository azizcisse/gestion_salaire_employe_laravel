<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeAdminRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Le Nom de l'Administrateur est requis.",
            'email.required' => "L'Adresse email de l'Administrateur est requis.",
            'email.email' => "L'Adresse email est invalide.",
            'email.unique' => "L'Adresse email est déjà lié à un Compte.",
        ];
    }
}
