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
        //
        Schema::create('menus', function (Blueprint $table) {
            $table->integer('id', true);
            // $table->integer('parent_id')->nullable();
            // $table->integer('lft')->nullable();
            // $table->integer('rght')->nullable();
            $table->boolean('active')->default(1);
            $table->string('icon')->nullable();
            $table->string('name', 45)->nullable();
            $table->string('description', 100)->nullable();
            $table->string('route_url', 254)->nullable()->comment("Route name, # or url https://external.com");
            $table->string('title', 100)->nullable();
            $table->string('extra_args')->nullable();
            $table->nestedSet();
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
