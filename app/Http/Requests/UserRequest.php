<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|max:45|min:4',
            'password' => 'required|min:8|max:30'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Svp vous devez fournir un nom d\'utilisateur',
            'name.min'=>'le nom doit contenir au moins 4 caractères',
            'name.max'=>'le nom ne doit pas dépasser 45 caractères',
            'password.required'=>'Svp vous devez fournir un mot de passe',
            'password.min'=>'le mot de passe doit contenir au moins 8 caractères',
            'password.max'=>'le mot de passe ne doit pas dépasser 30 caractères',
        ];
    }
}
