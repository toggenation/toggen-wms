<?php

namespace App\Http\Requests;

use App\Rules\BarcodeRule;
use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
{

    public function __construct(BarcodeRule $barcodeRule)
    {
        $this->barcodeRule = $barcodeRule;
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
            'active' => ['required'],
            'code' => ['required', 'max:100'],
            'description' => ['required', 'max:32'],
            'trade_unit_barcode' => [$this->barcodeRule],
            'consumer_unit_barcode' => ['nullable', $this->barcodeRule],
            'quantity' => ['required', 'max:10000', 'integer'],
            'city' => ['nullable', 'max:50'],
            'unit_net_contents' => ['required', 'numeric', 'max:10000'],
            'variant' => ['nullable', 'max:50'],
            'brand' => ['nullable', 'max:50'],
            'product_type_id' => ['required', 'exists:product_types,id'],
            'unit_of_measure_id' => ['nullable', 'exists:units_of_measure,id'],
            'comment' => ['nullable'],
            'min_days_life' => ['nullable'],
            'days_life' => ['nullable']
        ];
    }
}
