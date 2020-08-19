<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Variations2 extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->bigInteger('price');
            $table->bigInteger('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('variations', function (Blueprint $table) {
            //
        });
    }

}
