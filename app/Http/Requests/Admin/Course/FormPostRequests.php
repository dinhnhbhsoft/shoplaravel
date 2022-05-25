<?php

namespace App\Http\Requests\Admin\Course;

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
        $id = isset($this->course->id) ? $this->course->id : "";
        return [
            'name' => ['required', 'unique:courses,name,'.$id],
            'time_start' => 'required',
            'time_end' => 'required',
        ];
    }

    public function messages() : array
    {
        return [

        ];
    }
}
