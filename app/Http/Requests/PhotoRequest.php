<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
            'file' => 'required|image|mimes:jpeg,png,jpg,bmp|max:4048'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Svp vous devez fournir une photo pour ce médécin',
            'file.image' => 'Svp insérer une image',
            'file.mimes' => 'Entrez une image valide(jpeg,png,jpg,bmp) pour ce médécin',
            'file.max' => 'L\'image ne doit pas excéder 4Mo'
        ];
    }
}
