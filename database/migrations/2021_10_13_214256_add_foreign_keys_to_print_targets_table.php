<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPrintTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('print_targets', function (Blueprint $table) {
            $table->foreign(['output_type_id'], 'fk_print_targets_output_types1')->references(['id'])->on('print_output_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('print_targets', function (Blueprint $table) {
            $table->dropForeign('fk_print_targets_output_types1');
        });
    }
}
