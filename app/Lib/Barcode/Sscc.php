<?php

namespace App\Lib\Barcode;

/** not used atm */
class Sscc
{

    public $extensionDigit;

    public $serialReference;

    public $companyPrefix;

    const SSCC_LENGTH = 18;


    public function __construct($extensionDigit, $companyPrefix, $serialReference)
    {
        $this->extensionDigit = $extensionDigit;
        $this->companyPrefix = $companyPrefix;
        $this->serialReference = $serialReference;
    }
}
