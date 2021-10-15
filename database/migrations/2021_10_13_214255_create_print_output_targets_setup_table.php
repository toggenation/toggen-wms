<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintOutputTargetsSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_output_targets_setup', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('production_line_setup_id')->nullable()->index('fk_print_output_targets_setup_production_line_setup1_idx');
            $table->integer('print_target_id')->nullable()->index('fk_producution_line_setup_output_targets_print_targets1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_output_targets_setup');
    }
}
