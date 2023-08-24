<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreasurieDeliveriesControllerRequest extends FormRequest
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
           'treasuries_can_delivery_id' => 'required'
        ];
    }
    function messages()
    {
        return[
            'treasuries_can_delivery_id.required' => 'ضروري اخيار الخزنة الفرعية مطلوب',
        ];
    }
}
