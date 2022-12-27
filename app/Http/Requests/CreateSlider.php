<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSlider extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'front_image' => 'required',
            'front_image.*' => 'image|mimes:jpeg,png,jpg',
            'background_image' => 'required',
            'background_image.*' => 'image|mimes:jpeg,png,jpg',
        ];
    }
}
