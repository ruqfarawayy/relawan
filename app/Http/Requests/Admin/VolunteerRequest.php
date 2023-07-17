<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VolunteerRequest extends FormRequest
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
            'nra' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'occupation_id' => 'required',
            'education_id' => 'required',
            'blood_type' => 'required',
            'gender' => 'required',
            'birth_date'=> 'required|date',
            'unit_id'=> 'required',
            'volunteer_type_id' => 'required',
            'status'=> 'required|integer',
            // 'photo' => 'required|image'
        ];
    }
}
