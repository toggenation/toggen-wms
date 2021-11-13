<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PalletLabelPrintRequest extends FormRequest
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
            "item_id" => ['required', 'exists:items,id'],
            "production_line_id" => ['required', 'exists:production_lines,id'],
            "batch_no" => ['required'],
            "quantity" => ['integer', 'min:1'],
            "part_pallet" => ['nullable', 'boolean']
        ];
    }
}
