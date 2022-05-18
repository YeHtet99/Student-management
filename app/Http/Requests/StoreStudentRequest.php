<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name"=>"required|min:3|max:50",
            "email"=>"required|unique:families,email",
            "dob"=>"required",
            "photo"=>"nullable|mimes:jpg,jpeg,png|max:5000",
            "phone"=>"required|min:4|max:11",
            "mobile"=>"required|min:4|max:11",
            "dateofjoin"=>"required"
        ];
    }
}
