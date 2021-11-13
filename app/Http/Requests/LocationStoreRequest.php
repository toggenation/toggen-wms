<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationStoreRequest extends FormRequest
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
        return [
            'active' => ['boolean'],
            'name' => [
                'required',
                Rule::unique('locations', 'name')
            ],
            'description' => ['required'],
            'capacity' =>
            ['integer', 'between:1,' . $this->capacityMax],
            'product_type_id' => ['exists:product_types,id']
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => "This locaton :attribute already exists.",
            'capacity.integer' => 'The :attribute be a number',
            'capacity.between' => 'The :attribute must be between :min and :max',
            'product_type_id.exists' => 'Please select a product type'
        ];
    }
}
