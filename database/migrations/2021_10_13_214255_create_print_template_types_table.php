<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintTemplateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_template_types', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 50);
            $table->string('description', 100)->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->integer('sort_order')->nullable()->comment('Allow changing sort order for Template Headings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_template_types');
    }
}
