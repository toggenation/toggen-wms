<?php

namespace Tests\Feature;

use App\Services\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_location_class_can_generate_locations()
    {
        $location = new Location();

        $locations = $location->generate();
        $this->assertTrue(in_array('SSH1401', $locations));
        // $response->assertStatus(200);
    }
}
