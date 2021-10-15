<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductionLineSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_line_setup', function (Blueprint $table) {
            $table->foreign(['production_line_id'], 'fk_production_line_setup_production_lines1')->references(['id'])->on('production_lines')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_line_setup', function (Blueprint $table) {
            $table->dropForeign('fk_production_line_setup_production_lines1');
        });
    }
}
