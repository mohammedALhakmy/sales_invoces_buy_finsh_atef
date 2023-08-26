<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvuomsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required',
            'is_master' => 'required',
            'active' => 'required',
        ];
    }
    function messages()
    {
        return[
    'name.required' =>'اسم الوحده ضروري',
    'is_master.required' =>'هل هذه الوحده رئيسية',
    'active.required' =>'هل حاله الوحده مفعل'
       ];
    }
}
