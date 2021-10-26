<?php

namespace App\Exceptions;

use Exception;

class InvalidBarcodeException extends Exception
{
    public static function invalidSerialNumber()
    {
        return new static('SSCC reference number invalid');
    }

    public static function invalidExtensionDigit()
    {
        return new static("SSCC Extension digit must be a single digit");
    }

    public static function invalidCompanyPrefix()
    {
        return new static("SSCC Barcode Company Prefix Should be between 6 and 11 digits long");
    }
}
