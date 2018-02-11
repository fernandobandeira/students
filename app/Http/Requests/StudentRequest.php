<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $rules = [
            'nome' => 'required',
            'cpf'  => [
                'required',
                new Cpf(),
            ],
            'nascimento' => 'date_format:Y-m-d',
        ];

        if ($this->method() == 'PUT') {
            $rules['cpf'][] = 'unique:students,cpf,'.$this->student->id;
        } else {
            $rules['cpf'][] = 'unique:students,cpf';
        }

        return $rules;
    }
}
