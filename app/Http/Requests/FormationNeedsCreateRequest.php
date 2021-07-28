<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormationNeedsCreateRequest extends FormRequest
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
            'id', 'quantity', 'formation_year', 'institute_id', 'qualification_id', 'position_id', 'author_id', 'start_date', 'end_date'
        ];
    }
}
