<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_inventory', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('unit_of_measure_id')->nullable()->index('fk_inventory_units_of_measure1_idx');
            $table->integer('location_id')->nullable()->index('fk_inventory_locations1_idx');
            $table->timestamps();

            $table->integer('inventory_status_id')->nullable()->index('fk_inventory_inventory_statuses1_idx');
            $table->string('serial_number', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_inventory');
    }
}
