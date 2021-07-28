<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkUpdateRequest extends FormRequest
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
            'id',
		    'no_sk',
		    'start_date',
		    'end_date',
    	    'author_id',
            'created_at',
            'updated_at'
        ];
    }
}
