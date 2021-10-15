<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintActionsPrintTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_actions_print_targets', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('print_target_id')->nullable()->index('fk_print_actions_print_targets_print_targets1_idx');
            $table->integer('print_action_id')->nullable()->index('fk_print_actions_print_targets_print_actions1_idx');
            $table->boolean('default_target')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_actions_print_targets');
    }
}
