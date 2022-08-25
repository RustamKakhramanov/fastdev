<?php

namespace Kraify\Fastdev\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'tag_id' => 'nullable|integer',
            'notification_way' => 'string',
            'notification_key' => 'string',
            'code' => 'required|integer',
            'password' => 'required|string|confirmed',
        ];
    }
}
