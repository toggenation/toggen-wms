<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuUpdateRequest extends FormRequest
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
            'name' => ['required'],
            'active' => ['required'],
            'icon' => ['nullable', 'max:50'],
            'description' => ['nullable', 'max:100'],
            'route_url' => ['nullable', 'max:254'],
            'title' => ['nullable', 'max:100'],
            'extra_args' => ['nullable', 'max:100'],
            'parent_id' => ['nullable']
        ];
    }
}
