<?php

namespace Kraify\Fastdev\Http\Requests;

use Kraify\Fastdev\Country;
use Illuminate\Foundation\Http\FormRequest;

class CountryUpdateRequest extends FormRequest
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
        /* @var $country Country */
        $country = $this->route()->parameter('country');

        return [
            'name' => 'required|string|max:255|unique:countries,name,' . $country->id,
        ];
    }
}
