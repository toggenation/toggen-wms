<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PalletsTest extends TestCase
{

    use RefreshDatabase;

    public function test_a_pallet_can_be_added()
    {
        $this->actingAs(User::factory()->create(
            [
                'account_id' => Account::create(['name' => 'Acme Corporation'])
            ]
        ));

        $this->withoutExceptionHandling();

        $this->post('/pallet/add', [
            'items' => [
                [
                    'id' => 345,
                    'qty' => 5
                ]
            ],
            'production_line_id' => 1,
            'batch' => '2734455',
            'sscc_reference_number' => 22
        ]);


        $this->assertDatabaseCount('pallets', 1);
    }
}
