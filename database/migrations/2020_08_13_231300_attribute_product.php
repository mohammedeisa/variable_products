<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AttributeProduct extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('attribute_product', function (Blueprint $table) {
            $table->bigInteger('product_id');
            $table->bigInteger('attribute_id');
        });
        Schema::table('attribute_product', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('attribute_product', function (Blueprint $table) {
            //
        });
    }

}
