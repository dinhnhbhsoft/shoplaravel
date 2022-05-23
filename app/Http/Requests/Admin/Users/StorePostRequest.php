<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'email'=>'required|email:filter',
            'password' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'email.required' => 'This is a required field',
            'email.email:filter' => 'This is a email',
            'password.required' => 'This is a required field',
        ];
    }
}
