<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialiteRequest extends FormRequest
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
            'description' => 'required|min:20'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Svp vous devez fournir un nom de domaine médical',
            'name.min'=>'le nom doit contenir au moins 3 caractères',
            'name.max'=>'le nom ne doit pas dépasser 45 caractères',
            'description.required'=>'Svp vous devez fournir une description de ce domaine médical',
            'description.min'=>'la description doit contenir au moins 20 caractères',
        ];
    }
}
