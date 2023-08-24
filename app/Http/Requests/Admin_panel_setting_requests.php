<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Admin_panel_setting_requests extends FormRequest
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
            'system_name' => 'required',
            'address' => 'required',
            'general_alert' => 'required',
            'phone' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'system_name.required' => 'The name of System is Required',
            'address.required' => 'The Address of System is Required',
            'general_alert.required' => 'The General Alert of System is Required',
            'phone.required' => 'The phone  is Required',
        ];
    }
}
