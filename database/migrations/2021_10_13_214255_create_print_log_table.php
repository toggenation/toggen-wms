<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_log', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('print_data')->nullable();
            $table->string('controller_action', 100)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('print_action_id')->nullable();
            $table->integer('print_template_id')->nullable();
            $table->integer('printer_id')->nullable();
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
        Schema::dropIfExists('print_log');
    }
}
