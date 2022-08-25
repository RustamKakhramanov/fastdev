<?php

namespace Kraify\Fastdev\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsRegistrationRequest extends FormRequest
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
            'phone' => 'required|integer|digits:11|unique:users',
            'name' => 'required|string|max:255'
        ];
    }
}
