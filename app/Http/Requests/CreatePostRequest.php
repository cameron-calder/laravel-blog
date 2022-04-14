<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public $directory = 'thumbnails';

    /**
     * Append directory with dates
     */
    public function __construct()
    {
        $this->directory .= '/' . date('m');
        $this->directory .= '/' . date('d');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'thumbnail' => ['required', 'image', 'max:10000'],
        ];
    }
    
    public function saveImage()
    {
        return $this->file('thumbnail')
            ->store($this->directory, 'public');
    }
}
