<?php
/**
 * Created by PhpStorm.
 * User: yvano berthol
 * Date: 1/3/2019
 * Time: 4:49 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreneauRequest extends FormRequest
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
            'hdebut' => 'required|date_format:H:i',
            'hfin' => 'required|date_format:H:i',
        ];
    }

    public function messages()
    {
        return [
            'hdebut.required' => 'Svp vous devez fournir une heure de début',
            'hdebut.date_format'=>'l\'heure de début en dans le format HH:mm',
            'hfin.date_format'=>'l\'heure de fin en dans le format HH:mm',
            'hfin.required' => 'Svp vous devez fournir une heure de fin',
        ];
    }
}