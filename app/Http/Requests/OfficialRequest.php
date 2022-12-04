<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficialRequest extends FormRequest
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
        'name' => 'nullable',
        'phone_number' => 'nullable',
        'designation'   => 'nullable',
        'official_type_id' => 'nullable',
        'state_id' => 'nullable',
        'lga_id' => 'nullable',
        'ward_id' => 'nullable',
        'pollingUnit_id' => 'nullable'
        ];
    }
}