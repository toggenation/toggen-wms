<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemsPalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_pallet', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('pallet_id')->references('id')->on('pallets');
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
        Schema::table('item_pallet', function (Blueprint $table) {
            $table->dropForeign('fk_inventory_items_inventory');
            $table->dropForeign('fk_inventory_items_items1');
        });
    }
}
