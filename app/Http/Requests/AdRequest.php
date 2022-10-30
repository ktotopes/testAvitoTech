<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'name' => 'required|string|max:200',
            'description' => 'required|string|max:1000',
            'price'       => 'required|numeric|min:0.1',
            'photo'       => 'required|array|max:3',
            'photo.*'     => 'required|string|url',
        ];
    }
}
