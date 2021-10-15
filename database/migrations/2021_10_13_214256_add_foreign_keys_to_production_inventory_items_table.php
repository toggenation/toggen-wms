<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductionInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_inventory_items', function (Blueprint $table) {
            $table->foreign(['inventory_id'], 'fk_inventory_items_inventory')->references(['id'])->on('production_inventory')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['item_id'], 'fk_inventory_items_items1')->references(['id'])->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_inventory_items', function (Blueprint $table) {
            $table->dropForeign('fk_inventory_items_inventory');
            $table->dropForeign('fk_inventory_items_items1');
        });
    }
}
