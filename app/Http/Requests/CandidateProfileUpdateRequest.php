<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateProfileUpdateRequest extends FormRequest
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
            'nik', 'nuptk', 'full_name', 'title_ahead', 'back_title', 'date_of_birth', 'place_of_birth', 'tmt_start', 'tmt_end', 'user_id'
        ];
    }
}
