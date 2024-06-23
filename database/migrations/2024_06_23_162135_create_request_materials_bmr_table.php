<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestMaterialsBmrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_materials_bmr', function (Blueprint $table) {
            $table->id('request_materials_bmr_id');
            $table->unsignedBigInteger('billofmaterialbmr_id',);
            $table->foreign('billofmaterialbmr_id')->references('billofmaterialbmr_id')->on('bill_of_materialsbmr');
            $table->unsignedBigInteger('material_record_id',);
            $table->foreign('material_record_id')->references('material_record_id')->on('material_record_entries');
            $table->string("specification");
            $table->integer("standard_quantity");
            $table->integer("required_quantity");
            $table->string("unit_of_measuring");
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
        Schema::dropIfExists('request_materials_bmr');
    }
}
