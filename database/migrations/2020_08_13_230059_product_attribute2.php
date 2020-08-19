<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductAttribute2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
        public function create() {

        Schema::create('product_attribute', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->bigInteger('attribute_id');
        });
    }

    
    public function up()
    {
        Schema::table('product_attribute', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_attribute', function (Blueprint $table) {
            //
        });
    }
}
