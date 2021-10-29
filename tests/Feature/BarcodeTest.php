<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Barcode;
use App\Exceptions\InvalidBarcodeException;

class BarcodeTest extends TestCase
{
    protected Barcode $barcode;

    protected function setUp(): void
    {
        parent::setUp();

        $this->barcode = new Barcode();
    }

    public function test_throws_exception_when_co_prefix_short()
    {

        $this->expectException(InvalidBarcodeException::class);

        $this->barcode->sscc('1', '9311', 1);
    }
    public function test_create_sscc_works()
    {
        $sscc = $this->barcode->sscc('1', '9311123', 1123);

        $this->assertEquals('193111230000011230', $sscc);
    }
    public function test_for_bad_extension_arg()
    {
        $this->expectException(InvalidBarcodeException::class);

        $this->barcode->sscc('a', '1234567', 22);
    }
    public function test_for_bad_serialref()
    {
        $this->expectException(InvalidBarcodeException::class);
        $this->barcode->sscc(1, 3456789, "A");
    }

    public function test_zero_extension_and_serialref_is_ok()
    {
        $actual = $this->barcode->sscc(0, 3456789, 0);
        $this->assertEquals('034567890000000002', $actual);
    }

    public function test_leading_zero()
    {
        $sscc = $this->barcode->sscc('0', '0311123', 1123);

        $this->assertEquals('003111230000011232', $sscc);
    }

    public function test_should_return_false_on_bad_length()
    {
        //19 long 1234567890123456796
        $actual = $this->barcode->isValidBarcode('1234567890123456796');

        $this->assertFalse($actual, "Barcode of 19 long fails");
        // 16 long 
        $actual = $this->barcode->isValidBarcode('1234567890123452');
        $this->assertFalse($actual);
    }
}
