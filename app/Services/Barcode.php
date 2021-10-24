<?php

namespace App\Services;

class Barcode
{

    /**
     * Generate an SSCC number with check digit
     *
     * @return string
     *
     * phpcs:disable Generic.NamingConventions.CamelCapsFunctionName.ScopeNotCamelCaps
     */
    public function generateSSCCWithCheckDigit()
    {
        $sscc = $this->generateSSCC();

        return $sscc . $this->generateCheckDigit($sscc);
    }

    /**
     * when fed a barcode number returns the GS1 checkdigit number
     * @param string $number barcode number
     * @return string barcode number
     */
    public function checkDigit($number)
    {
        $sum = 0;
        $index = 0;
        $cd = 0;
        for ($i = strlen($number); $i > 0; $i--) {
            $digit = substr($number, $i - 1, 1);
            $index++;

            $ret = $index % 2;
            if ($ret == 0) {
                $sum += $digit * 1;
            } else {
                $sum += $digit * 3;
            }
        }
        $mod_sum = $sum % 10;
        // if it exactly divide the checksum is 0
        if ($mod_sum == 0) {
            $cd = 0;
        } else {
            // go to the next multiple of 10 above and subtract
            $cd = ((10 - $mod_sum) + $sum) - $sum;
        }

        return $cd;
    }



    public function generateSSCC($extensionDigit, $companyPrefix, $serialReference)
    {
        $barcode = $extensionDigit . $companyPrefix . $serialReference;
        if (strlen($barcode) !== 17) {
            throw new \Exception('SSCC Barcode without checkdigit should be 17 digits long');
        }

        return $barcode . $this->checkDigit($barcode);
    }
}
