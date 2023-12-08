<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
        ];

        // Verificar se a solicitação está em modo de edição
        if ($this->isMethod('put')) {
            // Obtenha o usuário que está sendo editado
            $user = $this->route('user');

            // Ignore a validação única se o e-mail não for alterado
            $rules['email'] = [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ];
        }

        return $rules;
    }


}
