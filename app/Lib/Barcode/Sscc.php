<?php

namespace App\Lib\Barcode;

use App\Models\Setting;
use App\Services\Barcode;

/** not used atm */
class Sscc
{
    protected $extensionDigit;
    protected $serialReference;
    protected $companyPrefix;

    const SSCC_LENGTH = 18;

    public function __construct(Setting $setting)
    {
        $settings = config('toggen.barcode.sscc');

        foreach ($settings as $key => $value) {
            $this->$key = $setting->get($value);
        }
    }

    public function get($sscc = null)
    {
        $ref = $sscc ?? $this->serialReference;
        return (new Barcode)->sscc($this->extensionDigit, $this->companyPrefix, $ref);
    }
}
