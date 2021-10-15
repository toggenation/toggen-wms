<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->foreign(['address_id'], 'fk_shipments_addresses1')->references(['id'])->on('addresses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['inventory_id'], 'fk_shipments_inventory1')->references(['id'])->on('production_inventory')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropForeign('fk_shipments_addresses1');
            $table->dropForeign('fk_shipments_inventory1');
        });
    }
}
