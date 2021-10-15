<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPrintActionsPrintTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('print_actions_print_targets', function (Blueprint $table) {
            $table->foreign(['print_action_id'], 'fk_print_actions_print_targets_print_actions1')->references(['id'])->on('print_actions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['print_target_id'], 'fk_print_actions_print_targets_print_targets1')->references(['id'])->on('print_targets')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('print_actions_print_targets', function (Blueprint $table) {
            $table->dropForeign('fk_print_actions_print_targets_print_actions1');
            $table->dropForeign('fk_print_actions_print_targets_print_targets1');
        });
    }
}
