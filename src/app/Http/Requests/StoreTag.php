<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTag extends FormRequest
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
            'tag_name' => 'sometimes|max:50',
            'content' => 'sometimes|max:50',
            'position_X' => 'sometimes|max:50',
            'position_Y' => 'sometimes|max:50',
            'visibility' => 'sometimes|max:50',
        ];
    }
}
