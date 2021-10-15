<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPrintOutputTargetsSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('print_output_targets_setup', function (Blueprint $table) {
            $table->foreign(['production_line_setup_id'], 'fk_print_output_targets_setup_production_line_setup1')->references(['id'])->on('production_line_setup')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['print_target_id'], 'fk_producution_line_setup_output_targets_print_targets1')->references(['id'])->on('print_targets')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('print_output_targets_setup', function (Blueprint $table) {
            $table->dropForeign('fk_print_output_targets_setup_production_line_setup1');
            $table->dropForeign('fk_producution_line_setup_output_targets_print_targets1');
        });
    }
}
