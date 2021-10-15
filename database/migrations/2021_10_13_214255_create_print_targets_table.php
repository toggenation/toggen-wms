<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_targets', function (Blueprint $table) {
            $table->integer('id', true);
            $table->boolean('active')->nullable();
            $table->string('name', 45)->nullable()->unique('name');
            $table->string('options', 100)->nullable();
            $table->string('target', 100)->nullable()->comment('This will hold a cups queue or email address, screen');
            $table->integer('output_type_id')->nullable()->index('fk_print_targets_output_types1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_targets');
    }
}
