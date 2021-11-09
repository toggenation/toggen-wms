<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Item;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use  RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_an_item_can_be_saved()
    {
        $account = Account::create(['name' => 'Acme Corporation']);
        $user = User::factory()->create(['account_id' => $account->id]);

        $this->actingAs($user);

        $productType = ProductType::factory()->create();
        $this->withoutExceptionHandling();

        $item = Item::factory()->raw();

        $this->post('/data/items/store', $item);

        $this->assertDatabaseHas('items', $item);
    }
}
