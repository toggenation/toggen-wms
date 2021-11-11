<?php

namespace Tests\Unit;

use App\Rules\FilenameRule;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\TestCase;

class FilenameRuleTest extends TestCase
{

    // public function setUp(): void
    // {
    //     parent::setUp();
    // }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGlabelsTxtNiceLabelsPasses()
    {
        $rule = new FilenameRule(['glabels', 'txt', 'nlbl']);
        //public function __construct(string $path, string $originalName, string $mimeType = null, int $error = null, bool $test = false)
        $path = __DIR__ . '/B7nuLlnSpo5Gdwofone7yxWV535dVMPbbXFQnyAy.gz';

        $file = new UploadedFile($path, '150x200-shipping-labels-generic.glabels', '', null, true);
        // var_dump($file);
        $this->assertTrue($rule->passes('template', $file));
    }

    public function testBadFileNameFails()
    {
        $rule = new FilenameRule(['glabels', 'txt', 'nlbl']);
        //public function __construct(string $path, string $originalName, string $mimeType = null, int $error = null, bool $test = false)
        $path = __DIR__ . '/B7nuLlnSpo5Gdwofone7yxWV535dVMPbbXFQnyAy.gz';

        $file = new UploadedFile($path, 'file.csv', '', null, true);
        // var_dump($file);
        $this->assertFalse($rule->passes('template', $file));
    }
}
