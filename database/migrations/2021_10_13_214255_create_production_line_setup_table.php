<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionLineSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_line_setup', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('production_line_id')->nullable()->index('fk_production_line_setup_production_lines1_idx');
            $table->integer('item_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('batch_format_id')->nullable();
            $table->string('batch_manual', 30)->nullable()->comment('6 digits');
            $table->integer('batch_use_manual')->nullable()->default(0);
            $table->integer('number_range_id')->nullable()->comment('Serial number range');
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
        Schema::dropIfExists('production_line_setup');
    }
}
