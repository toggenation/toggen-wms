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
            $table->integer('id', true);
            $table->boolean('active')->nullable();
            $table->string('name', 45)->unique('print_template_name_uq');
            $table->string('description', 100)->nullable();
            $table->string('template_path')->nullable();
            $table->string('sample_image')->nullable();
            $table->integer('print_template_type_id')->nullable()->index('fk_print_templates_print_template_types1_idx');
            $table->boolean('show_in_label_chooser')->nullable();
            $table->string('replace_tokens', 2000)->nullable();
            $table->string('print_class');
            $table->string('controller_action');
            $table->timestamps();

            $table->string('comment')->nullable();
            $table->integer('sort_order')->nullable()->comment('Allow changing sort order');
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
