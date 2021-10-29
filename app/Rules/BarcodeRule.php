<?php

namespace App\Rules;

use App\Services\Barcode;
use Illuminate\Contracts\Validation\Rule;
use phpDocumentor\Reflection\Types\Boolean;

/**
 *  This rule class validate barcodes use like:
 * 
 *  $validatedData = $request->validate([
 *      'barcode' => [new Barcode]
 *  ]);
 */

class BarcodeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct(Barcode $barcode)
    {
        $this->barcode = $barcode;
    }
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->barcode->isValidBarcode($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid barcode.';
    }
}
