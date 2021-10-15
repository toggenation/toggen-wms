<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductionInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_inventory', function (Blueprint $table) {
            $table->foreign(['inventory_status_id'], 'fk_inventory_inventory_statuses1')->references(['id'])->on('inventory_statuses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['location_id'], 'fk_inventory_locations1')->references(['id'])->on('locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['unit_of_measure_id'], 'fk_inventory_units_of_measure1')->references(['id'])->on('units_of_measure')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_inventory', function (Blueprint $table) {
            $table->dropForeign('fk_inventory_inventory_statuses1');
            $table->dropForeign('fk_inventory_locations1');
            $table->dropForeign('fk_inventory_units_of_measure1');
        });
    }
}
