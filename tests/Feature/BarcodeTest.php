<?php

namespace Tests\Feature;

use App\Rules\Barcode as RulesBarcode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Barcode;
use App\Rules\Barcode as BarcodeRule;
use App\Exceptions\InvalidBarcodeException;

class BarcodeTest extends TestCase
{
    protected Barcode $barcode;
    protected BarcodeRule $barcodeRule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->barcode = new Barcode();
        $this->barcodeRule = new BarcodeRule();
    }

    public function test_throws_exception_when_co_prefix_short()
    {

        $this->expectException(InvalidBarcodeException::class);

        $this->barcode->generateSSCC('1', '9311', 1);
    }
    public function test_create_sscc_works()
    {
        $sscc = $this->barcode->generateSSCC('1', '9311123', 1123);

        $this->assertEquals('193111230000011230', $sscc);
    }
    public function test_for_bad_extension_arg()
    {
        $this->expectException(InvalidBarcodeException::class);

        $this->barcode->generateSSCC('a', '1234567', 22);
    }
    public function test_for_bad_serialref()
    {
        $this->expectException(InvalidBarcodeException::class);
        $this->barcode->generateSSCC(1, 3456789, "A");
    }

    public function test_for_zero_serialref()
    {
        $this->expectException(InvalidBarcodeException::class);
        $this->barcode->generateSSCC(1, 3456789, 0);
    }

    public function test_leading_zero()
    {
        $sscc = $this->barcode->generateSSCC('0', '0311123', 1123);

        $this->assertEquals('003111230000011232', $sscc);
    }
}
