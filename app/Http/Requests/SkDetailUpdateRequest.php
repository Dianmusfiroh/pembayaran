<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkDetailUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ture;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gtt_id',
            'sk_id'
        ];
    }
}
