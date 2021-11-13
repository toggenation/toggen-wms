<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Location;
use App\Models\Pallet;
use App\Models\ProductionLine;
use App\Models\ProductType;
use App\Models\Setting;
use App\Models\User;
use App\Services\Batch;
use Carbon\Carbon;
use Database\Factories\SettingFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class PalletLabelPrintTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     * 
     * @test
     */
    public function a_post_to_pallet_print_creates_record()
    {
        $user = User::factory()->create(['account_id' => 1]);
        $this->actingAs($user);

        $productType = ProductType::factory()->create();

        $location = Location::factory()->create();

        $item = Item::factory()->create([
            'product_type_id' => $productType->id
        ]);

        $setting = Setting::factory()->create([
            'active' => true,
            'name' => 'SSCC_REFERENCE',
            'setting' => 23
        ]);

        $productionLine = ProductionLine::factory()->create();

        $batch = (new Collection(App::make(Batch::class)->generate()))->random()['batch'];

        $sscc_ref = (new Setting)->get('SSCC_REFERENCE');



        $palletData = [
            'sscc_reference_number' => $sscc_ref->setting,
            'location_id' => $location->id
        ];

        $pallet = Pallet::create($palletData);

        $item_pallet = [
            'quantity' => $item->quantity,
            'bb_date' => Carbon::now()->addDays($item->days_life),
            'batch_number' => $batch,
            'item_code' => $item->code,
            'item_description' => $item->description,
            'item_barcode' => $item->trade_unit_barcode,
            'production_line_id' => $productionLine->id,
            'user_id' => auth()->user()->id
        ];

        // dd($item_pallet);

        $pallet->items()->attach($item->id, $item_pallet);

        // "item_id" => 7
        // "production_line_id" => "3"
        // "batch_no" => "131602"
        // "quantity" => 132
        // "part_pallet" => false
        $response = $this->post(route('print.pallet-print'), [
            'item_id' => $item->id,
            'production_line_id' => $productionLine->id,
            'batch_no' => $batch,
            'quantity' => $item->quantity
        ]);

        // dd($record);

        $this->assertDatabaseCount('item_pallet', 1);

        $this->assertDatabaseHas('item_pallet', $item_pallet);

        $this->assertDatabaseHas('pallets', $palletData);

        // pallet create a database record but dont 


        // $response->assertStatus(200);
    }
}
