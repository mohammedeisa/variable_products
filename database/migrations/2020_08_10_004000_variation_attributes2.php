<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VariationAttributes2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('variation_attributes', function (Blueprint $table) {
            $table->bigInteger('variation_id');
            $table->bigInteger('attribute_id');
            $table->foreign('variation_id')->references('id')->on('variations');
            $table->foreign('attribute_id')->references('id')->on('attributes');
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
        Schema::table('variation_attributes', function (Blueprint $table) {
            //
        });
    }
}
