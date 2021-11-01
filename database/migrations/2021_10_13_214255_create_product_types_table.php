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
            $table->unsignedBigInteger('id', true);
            $table->integer('default_inventory_status_id')->nullable()->comment('Initial inventory status when record is created');
            $table->boolean('active')->nullable();
            $table->string('name', 32)->unique();
            $table->string('storage_temperature', 20);
            $table->integer('location_id')->nullable()->index('fk_product_types_locations1_idx');
            $table->boolean('enable_pick_app')->nullable();
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
        Schema::dropIfExists('product_types');
    }
}
