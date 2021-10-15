<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumberRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_ranges', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 45)->nullable();
            $table->string('description', 100)->nullable();
            $table->string('php_class')->nullable()->comment('Holds PHP class to generate the value');
            $table->json('number_range_data')->nullable()->comment('passed as options to number_range_class');
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
        Schema::dropIfExists('number_ranges');
    }
}
