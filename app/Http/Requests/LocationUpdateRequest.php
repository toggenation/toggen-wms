<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationUpdateRequest extends FormRequest
{

    protected $capacityMax;

    public function __construct()
    {
        $this->capacityMax = config('toggen.warehouse.capacity.max');
    }


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
        $id = $this->route()->parameters()['location']->id;

        return [
            'product_type_id' => ['required', 'exists:product_types,id'],
            'description' => ['nullable'],
            'name' => [
                'required',
                Rule::unique('locations', 'name')->ignore($id)
            ],
            'active' => ['boolean'],
            'capacity' => [
                'integer',
                'between:1,' . $this->capacityMax
            ]
        ];
    }
}
