<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnnonceRequest extends FormRequest
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
            'title' => 'required|max:255',
            'location' => 'required',
            'description' => 'required',
            'profileSearched' => 'required',
            'advantages' => 'required',
            'type' => ['required',  Rule::in(['f-t', 'h-t', 'f'])],
            'category' => ['required' ,Rule::in(['c-t','c-a','c-e','c-m','c-f','c-h','c-ag','c-o'])],
            'salary' => 'required|numeric'
        ];
    }
}
