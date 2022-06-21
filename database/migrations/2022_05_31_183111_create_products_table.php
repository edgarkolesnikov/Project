<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->float('price');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('cloth_id');
            $table->integer('color_id');
            $table->integer('brand_id');
            $table->integer('size_id');
            $table->integer('material_id');
            $table->integer('views');
            $table->integer('status_id');
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
        Schema::dropIfExists('products');
    }
};
