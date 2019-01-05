<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedecinRequest extends FormRequest
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
            'matricule' => 'required|max:6|min:3',
            'firstname' => 'required|max:45|min:3',
            'lastname' => 'required|max:45|min:3',
            'telephone' => 'required|numeric',
            'date' => 'required|date',
            'sexe' => 'required',
            'residence' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,bmp|max:4048'
        ];
    }

    public function messages()
    {
        return [
            'matricule.required' => 'Svp vous devez fournir un matricule',
            'matricule.min'=>'le matricule doit contenir au moins 3 caractères',
            'matricule.max'=>'le matricule ne doit pas dépasser 6 caractères',
            'firstname.required' => 'Svp vous devez fournir un nom',
            'firstname.min'=>'le nom doit contenir au moins 3 caractères',
            'firstname.max'=>'le nom ne doit pas dépasser 45 caractères',
            'lastname.required' => 'Svp vous devez fournir un prénom',
            'lastname.min'=>'le prénom doit contenir au moins 3 caractères',
            'lastname.max'=>'le prénom ne doit pas dépasser 45 caractères',
            'telephone.required'=>'Svp vous devez fournir un telephone',
            'telephone.numeric'=>'Svp le telephone est une suite de nombre',
            'sexe.required'=>'Svp vous devez fournir un sexe pour ce médécin',
            'date.required'=>'Svp vous devez fournir un date de naissance',
            'date.date'=>'Svp c\'une date qu\'il faut fournir',
            'residence.required'=>'Svp vous devez fournir une ville de résidence pour ce médécin',
            'photo.required' => 'Svp vous devez fournir une photo pour ce médécin',
            'photo.image' => 'Svp insérer une image',
            'photo.mimes' => 'Entrez une image valide(jpeg,png,jpg,bmp) pour ce médécin',
            'photo.max' => 'L\'image ne doit pas excéder 4Mo'
        ];
    }
}
