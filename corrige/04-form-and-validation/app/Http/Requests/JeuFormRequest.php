<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JeuFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => 'bail|required|between:5,20|alpha',
            'editeur' => 'bail|required|',
            'categorie' => 'bail|required|max:250'
        ];
    }
}
