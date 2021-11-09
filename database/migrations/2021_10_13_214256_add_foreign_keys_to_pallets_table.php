<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pallets', function (Blueprint $table) {
            $table->foreign(['inventory_status_id'], 'fk_inventory_inventory_statuses1')
                ->references(['id'])->on('inventory_statuses')
                ->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['location_id'], 'fk_inventory_locations1')->references(['id'])->on('locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pallets', function (Blueprint $table) {
            $table->dropForeign('fk_inventory_inventory_statuses1');
            $table->dropForeign('fk_inventory_locations1');
            $table->dropForeign('fk_inventory_units_of_measure1');
        });
    }
}
