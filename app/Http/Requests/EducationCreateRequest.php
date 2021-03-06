<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationCreateRequest extends FormRequest
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
            'year_edu',
            'institution_id',
            'study_program_id',
            'department_id',
            'qualification_id',
            'user_id'
        ];
    }
}
