<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class submitdefineAccessRequest extends FormRequest
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
            'code' => 'required|exists:code_initialisation_motde_passes,code',
            'password' => 'required|same:confirm_password',
            'password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Le Code est requis.',
            'code.exists' => 'Le Code est invalide. Consultez votre Boite Email.',
            'password.same' => 'Les deux Mot de Passe ne sont pas identiques.',
            'confirm_password.same' => 'Les deux Mot de Passe ne sont pas identiques.',
        ];
    }
}
