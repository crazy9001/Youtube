<?php

namespace Youtube\Auth\Http\Requests;

use Youtube\Base\Http\Requests\Request;

class LoginRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @author Toinn
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Toinn
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => trans('auth::auth.validate.username.required'),
            'password.required' => trans('auth::auth.validate.password.required')
        ];
    }
}
