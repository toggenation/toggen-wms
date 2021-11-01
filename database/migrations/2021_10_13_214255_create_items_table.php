<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id', true);
            $table->boolean('active');
            $table->string('code', 10)->unique('code');
            $table->string('description', 32);
            $table->integer('quantity');
            $table->string('trade_unit_barcode', 14)->nullable();
            $table->string('consumer_unit_barcode', 14)->nullable();
            $table->unsignedBigInteger('product_type_id')->index('fk_items_product_types1_idx');
            $table->string('brand', 32)->nullable();
            $table->string('variant', 32)->nullable();
            $table->integer('unit_net_contents')->nullable();
            $table->integer('unit_of_measure_id')->nullable()->index('fk_items_units_of_measure1_idx');
            $table->integer('days_life')->nullable();
            $table->integer('min_days_life')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
