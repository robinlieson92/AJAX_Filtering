<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
        //$id = $this->gallery;
        return [
            'title' => 'required|max:255',
            'urlimage' => 'required|max:200|image|mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required, at least fill a character',
            'urlimage.required' => 'Image is required, please upload a picture',
            'urlimage.max' => 'The Image may not be greater than 200KB',
            'urlimage.image' => 'The File must be image / picture',
            'urlimage.mimes' => 'The File must be image / picture',

        ];
    }
}
