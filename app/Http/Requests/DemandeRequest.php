<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DemandeRequest extends FormRequest
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
            'activity' =>[ 'required',Rule::in('c-t','c-a','c-e','c-m','c-f','c-h','c-ag','c-0')],
            'location' => 'required',
            'tel' => 'required|numeric',
            'description' =>'required',

        ];
    }
}
