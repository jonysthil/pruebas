<?php

namespace Agenda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules() {
        return [
            'stsId' => 'required|numeric',
            'cntNombre' => 'required',
            'cntApellidoPaterno' => 'required|max:30',
            'cntApellidoPaterno' => 'max:30',
            'cntFotografia' => 'mimes:jpeg,jpg|max:255'
        ];
    }
}
