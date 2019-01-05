<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|max:45|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Svp vous devez fournir un nom de role',
            'name.min'=>'le nom doit contenir au moins 3 caractères',
            'name.max'=>'le nom ne doit pas dépasser 45 caractères',
        ];
    }
}
