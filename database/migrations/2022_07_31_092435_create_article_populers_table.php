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
        Schema::create('article_populers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('article_id');
            $table->integer('view')->default(0);
            $table->integer('like')->default(0);
            $table->integer('komen')->default(0);
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
        Schema::dropIfExists('article_populers');
    }
};
