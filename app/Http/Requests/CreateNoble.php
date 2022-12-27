<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNoble extends FormRequest
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
            'noble_category' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg',
            'download_file' => 'required',
            'download_file.*' => 'file|mimes:pdf',
            'body' => 'required',
        ];
    }
}
