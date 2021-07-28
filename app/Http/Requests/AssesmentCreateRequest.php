<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssesmentCreateRequest extends FormRequest
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
            'score' => 'required',
            'formation_id' => 'required|exists:formation,id',
            'candidate_id' => 'required|exists:formation,candidate_id'];
    }
}
