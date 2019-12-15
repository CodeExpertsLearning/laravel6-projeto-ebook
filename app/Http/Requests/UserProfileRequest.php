<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'user.name' => 'required',
	        'user.email' => 'required|email'
        ];
    }

	public function messages()
	{
		return [
			'required' => 'Este campo é obritário',
			'email'    => 'E-mail digitado é inválido'
		];
	}
}
