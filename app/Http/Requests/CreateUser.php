<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'description' => 'required',
            'profile_photo' => 'required',
            'profile_photo.*' => 'image|mimes:jpeg,png,jpg',
            'cover_photo' => 'required',
            'cover_photo.*' => 'image|mimes:jpeg,png,jpg',
            'user_type' => 'required',
        ];
    }
}
