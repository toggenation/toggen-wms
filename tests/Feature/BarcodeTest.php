<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Barcode;

class BarcodeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->barcode = new Barcode();
    }

    public function test_short_sscc_throws_exception()
    {

        $this->expectException(\Exception::class);

        $this->barcode->generateSSCC('1', '01234567', 1);
    }
    public function test_create_sscc_works()
    {
        $sscc = $this->barcode->generateSSCC('1', '01234567', 1);

        $this->assertEquals('193111230000011230', $sscc);
    }
}
