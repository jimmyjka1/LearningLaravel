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
            $table -> id();
            $table -> string('name') -> nullable();
            $table -> bigInteger('brand_id') -> nullable();
            $table -> bigInteger('category_id') -> nullable();
            $table -> float('stock') -> nullable();
            $table -> float('price') -> nullable();
            $table -> text('image') -> nullable();
            $table -> text('description') -> nullable();
            $table -> integer('status') -> comment('0 -> in-active, 1 - active') -> nullable();
            $table -> timestamps();
            $table -> softDeletes();
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
