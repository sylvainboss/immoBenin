<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' =>['required','min:8'],
            'adresse'=>['required','min:8'],
            'ville_id'=>['required'],
            'prix'=>['required', 'integer', 'min:1000'],
            'type'=>['required'],
            'superficie'=>['required','min:10'],
            'userid'=>['required'],
            'accept'['boolean'],
            'nombre_piece' =>['nullable'],
            'document'=>['required','file','mimes:pdf','max:2048'],
        ];
    }
}
