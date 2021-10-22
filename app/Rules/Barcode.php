<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use phpDocumentor\Reflection\Types\Boolean;

/**
 *  This rule class validate barcodes use like:
 * 
 *  $validatedData = $request->validate([
 *      'barcode' => [new Barcode]
 *  ]);
 */

class Barcode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return $this->isValidBarcode($value);
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
    /**
     * isValidBarcode
     * 
     *
     * @param string $barcode
     * @return boolean
     */
    function isValidBarcode(string $barcode): bool
    {
        //checks validity of: GTIN-8, GTIN-12, GTIN-13, GTIN-14, GSIN, SSCC
        //see: http://www.gs1.org/how-calculate-check-digit-manually
        $barcode = (string) $barcode;
        //we accept only digits
        if (!preg_match("/^[0-9]+$/", $barcode)) {
            return false;
        }
        //check valid lengths:
        $l = strlen($barcode);
        if (!in_array($l, [8, 12, 13, 14, 17, 18]))
            return false;
        //get check digit
        $check = substr($barcode, -1);
        $barcode = substr($barcode, 0, -1);
        $sum_even = $sum_odd = 0;
        $even = true;
        while (strlen($barcode) > 0) {
            $digit = substr($barcode, -1);
            if ($even)
                $sum_even += 3 * $digit;
            else
                $sum_odd += $digit;
            $even = !$even;
            $barcode = substr($barcode, 0, -1);
        }
        $sum = $sum_even + $sum_odd;
        $sum_rounded_up = ceil($sum / 10) * 10;
        return ($check == ($sum_rounded_up - $sum));
    }
}
