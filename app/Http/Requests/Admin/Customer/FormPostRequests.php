<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;

class FormPostRequests extends FormRequest
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
        $id = isset($this->customer->id) ? $this->customer->id : "";
        return [
            'full_name' => 'required',
            'email' => ['required', 'email', 'unique:customers,email,'.$id],
            'birthday' => 'required',
            'phone_number' => ['required', 'regex:/^((\+84|0)(3|5|7|8|9))[0-9]{8}$/'],
            'avatar' => 'image',
        ];
    }

    public function messages() : array
    {
        return [

        ];
    }
}
