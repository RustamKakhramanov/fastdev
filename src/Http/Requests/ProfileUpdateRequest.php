<?php

namespace Kraify\Fastdev\Http\Requests;

use Kraify\Fastdev\Rules\Lowercase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name' => 'string|max:255',
            'email' => $this->getEmailUpdateValidationRules($request),
            'phone' => "nullable|unique:users,phone,{$request->user()->id}|integer|digits:11",
            'password' => 'string|min:8|max:255',
        ];
    }

    public function getEmailUpdateValidationRules(Request $request): array
    {
        $email = $request->input('email');
        $user = $request->user();

        $emailUpdateValidationRules = [
            'string',
            'email',
            'unique:users,email,' . $user->id,
            new Lowercase,

            'max:100'
        ];

        if (empty($email) && $user->email === $user->default_email) {
            $emailUpdateValidationRules[] = 'nullable';
        }

        return $emailUpdateValidationRules;
    }
}
