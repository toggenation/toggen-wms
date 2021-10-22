<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreign(['product_type_id'], 'fk_items_product_types1')->references(['id'])->on('product_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['unit_of_measure_id'], 'fk_items_units_of_measure1')->references(['id'])->on('units_of_measure')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('fk_items_pack_sizes1');
            $table->dropForeign('fk_items_product_types1');
            $table->dropForeign('fk_items_units_of_measure1');
        });
    }
}
