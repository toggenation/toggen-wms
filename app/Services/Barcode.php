<?php

namespace App\Services;

use App\Exceptions\InvalidBarcodeException;
use App\Rules\Barcode as BarcodeRule;
use Tests\Feature\BarcodeTest;

class Barcode
{
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

    private function validate($extensionDigit, $companyPrefix, $serialReference)
    {
        // serialReference must be greater than zero and a number
        if (!is_numeric($serialReference) || $serialReference < 1) {
            throw InvalidBarcodeException::invalidSerialNumber();
        }

        if (preg_match('/^\d$/', $extensionDigit) !== 1) {
            throw InvalidBarcodeException::invalidExtensionDigit();
        }

        $coPrefixLength = strlen($companyPrefix);

        // coPrefix is between 6 and 
        if ($coPrefixLength < 6 || $coPrefixLength > 11) {
            throw InvalidBarcodeException::invalidCompanyPrefix();
        }
    }


    public function generateSSCC($extensionDigit, $companyPrefix, $serialReference)
    {
        $this->validate($extensionDigit, $companyPrefix, $serialReference);

        $barcode = $extensionDigit . $companyPrefix;

        $serialLength = 17 - strlen($barcode);

        $format = '%0' . $serialLength . 'd';

        $barcode .= sprintf($format, $serialReference);

        $barcode = $barcode . $this->checkDigit($barcode);

        return $barcode;
    }
}
