<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'nome'            => 'required',
            'mensalidade'     => 'required|min:0|max:99999999.99|numeric',
            'valor_matricula' => 'required|min:0|max:99999999.99|numeric',
            'periodo'         => 'required',
            'duracao'         => 'required|integer|min:0|max:999',
        ];
    }
}
