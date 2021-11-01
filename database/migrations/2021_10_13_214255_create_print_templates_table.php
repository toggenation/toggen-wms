<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->nullable();
            $table->string('name', 45)->unique('print_template_name_uq');
            $table->string('description', 100)->nullable();
            $table->string('template_path')->nullable();
            $table->string('sample_image')->nullable();
            $table->boolean('label_chooser')->nullable();
            $table->string('print_class');
            $table->string('route');
            $table->string('comment')->nullable();
            $table->integer('sort_order')->nullable()->comment('Allow changing sort order');
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
        Schema::dropIfExists('print_templates');
    }
}
