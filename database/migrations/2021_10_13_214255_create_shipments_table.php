<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('shipment_number', 30);
            $table->string('consignment_note', 50);
            $table->integer('address_id')->index('fk_shipments_addresses1_idx');
            $table->integer('pallet_id')->nullable()->index('fk_shipments_inventory1_idx');
            $table->integer('pallet_count');
            $table->boolean('shipped');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
