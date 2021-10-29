<?php

namespace App\Services;

use App\Exceptions\InvalidBarcodeException;

class Barcode
{
    const SSCC_LENGTH = 18;
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

    public function onlyDigits($barcode)
    {
        return preg_match("/^[0-9]+$/", $barcode);
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
        if (!$this->onlyDigits($barcode)) {
            return false;
        }
        //check valid lengths:
        $length = strlen($barcode);
        if (!$this->isValidLength($length))
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

    public function isValidLength($length)
    {
        return in_array($length, [8, 12, 13, 14, 17, 18]);
    }

    public function validate($barcode, $type)
    {
        if ($this->isValidBarcode($barcode)) {
            return true;
        }

        throw new InvalidBarcodeException('Invalid ' . $type . ' barcode');
    }

    public function sscc($extensionDigit, $companyPrefix, $serialReference)
    {
        $type = 'SSCC';

        $this->checkSsccArguments($extensionDigit, $companyPrefix, $serialReference);

        $sscc = $this->generate($type, $companyPrefix, $serialReference, self::SSCC_LENGTH, $extensionDigit, $type);

        $this->validate($sscc, $type);

        return $sscc;
    }

    public function generate($type, $companyPrefix, $serialReference, $length, $extensionDigit = '')
    {
        $barcode = (string) $extensionDigit . $companyPrefix;

        $serialLength = $length - strlen($barcode) - 1;

        $format = '%0' . $serialLength . 'd';

        $barcode .= sprintf($format, $serialReference);

        $barcode = $barcode . (string) $this->checkDigit($barcode);

        $this->validate($barcode, $type);

        return $barcode;
    }

    public function extensionDigit($extensionDigit)
    {
        return preg_match("/^[0-9]$/", $extensionDigit);
    }

    private function checkSsccArguments($extensionDigit, $companyPrefix, $serialReference)
    {
        // serialReference must be greater than zero and a number
        if (!is_numeric($serialReference)) {
            throw InvalidBarcodeException::invalidSerialNumber();
        }

        // 0-9 only
        if (!$this->extensionDigit($extensionDigit)) {
            throw InvalidBarcodeException::invalidExtensionDigit();
        }

        $coPrefixLength = strlen($companyPrefix);

        // coPrefix is between 6 and 
        if ($coPrefixLength < 6 || $coPrefixLength > 11) {
            throw InvalidBarcodeException::invalidCompanyPrefix();
        }
    }
}
