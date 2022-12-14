<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvent extends FormRequest
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
            'location' => 'required',
            'event_date' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg',
            'body' => 'required',
            'event_photo' => 'required',
            'event_photo.*' => 'image|mimes:jpeg,png,jpg',
            
        ];
    }
}
