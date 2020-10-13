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
            'valve_name' => 'sometimes|max:50',
            'valve_number' => 'sometimes|max:50',
            'valve_usuallyState' => 'sometimes|max:50',
            'valve_state' => 'sometimes|max:50',
            'valve_memo' => 'sometimes|max:50',
        ]; 
    }
}
