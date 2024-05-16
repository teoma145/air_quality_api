<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreprojectRequest extends FormRequest
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
            'name'=>['required','min:3','max:200','unique:projects'],
            'description'=>['nullable'],
            'language'=>['nullable'],
            'image'=>['nullable','image']
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Il titolo è obbligatorio',
            'name.min'=>'Il titolo deve avere almeno :min caratteri',
            'name.max'=>'Il titolo deve avere massimo :max caratteri',
            'name.unique'=>'Il titolo è univoco',

        ];
    }
}
