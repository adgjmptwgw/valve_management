<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOption extends FormRequest
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
            'valve_name' => 'sometimes|max:15',
            'valve_number' => 'sometimes|max:30',
            'valve_usuallyState' => 'sometimes|max:3',
            'valve_state' => 'sometimes|max:3',
            'valve_memo' => 'sometimes|max:100',
        ];
    }
}
