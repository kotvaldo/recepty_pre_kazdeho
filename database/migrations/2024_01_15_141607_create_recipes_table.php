<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('ingredients');
            $table->text('instructions');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedTinyInteger('difficulty');
            $table->unsignedInteger('cooking_time');
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('recipes');
    }
};
