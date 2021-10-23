<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_inventory_items', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedInteger('item_id')->nullable()->index('fk_inventory_items_items1_idx');
            $table->integer('inventory_id')->nullable()->index('fk_inventory_items_inventory_idx');
            $table->integer('quantity')->nullable();
            $table->date('bb_date')->nullable();
            $table->string('batch_number', 45)->nullable();
            $table->integer('item_serial_number')->nullable();
            $table->string('item_code', 45)->nullable();
            $table->string('item_description', 100)->nullable();
            $table->string('item_barcode', 14)->nullable();
            $table->integer('production_line_id')->nullable();
            $table->integer('product_type_id')->nullable();
            $table->integer('producution_line_setup_output_targets_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('qty_user_id')->nullable();
            $table->dateTime('production_date')->nullable();
            $table->integer('inventory_status_id')->nullable();
            $table->string('qa_note', 100)->nullable();
            $table->dateTime('inventory_status_date')->nullable();
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
        Schema::dropIfExists('production_inventory_items');
    }
}
