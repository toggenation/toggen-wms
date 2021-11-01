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
        Schema::table('items_pallets', function (Blueprint $table) {
            $table->foreign(['inventory_id'], 'fk_inventory_items_inventory')->references(['id'])->on('pallets')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::table('items_pallets', function (Blueprint $table) {
            $table->dropForeign('fk_inventory_items_inventory');
            $table->dropForeign('fk_inventory_items_items1');
        });
    }
}
