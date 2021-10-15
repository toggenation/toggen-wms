<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rght')->nullable();
            $table->boolean('active');
            $table->boolean('divider');
            $table->boolean('admin_menu');
            $table->string('name', 45)->nullable();
            $table->string('description', 45)->nullable();
            $table->string('url', 254)->nullable();
            $table->string('title', 50)->nullable();
            $table->string('controller_action');
            $table->string('extra_args');
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
        Schema::dropIfExists('menus');
    }
}
