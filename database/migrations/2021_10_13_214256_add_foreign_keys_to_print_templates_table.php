<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPrintTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('print_templates', function (Blueprint $table) {
            $table->foreign(['print_template_type_id'], 'fk_print_templates_print_template_types1')->references(['id'])->on('print_template_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('print_templates', function (Blueprint $table) {
            $table->dropForeign('fk_print_templates_print_template_types1');
        });
    }
}
