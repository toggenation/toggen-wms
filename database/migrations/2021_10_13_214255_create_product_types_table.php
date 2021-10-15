<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('default_inventory_status_id')->nullable()->comment('Initial inventory status when record is created');
            $table->boolean('active')->nullable();
            $table->string('name', 20);
            $table->string('code_prefix', 20);
            $table->string('storage_temperature', 20);
            $table->integer('default_putaway_location_id')->nullable()->index('fk_product_types_locations1_idx');
            $table->string('code_regex', 45);
            $table->string('code_regex_description', 100);
            $table->boolean('enable_pick_app')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_types');
    }
}
