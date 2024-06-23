<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillOfMaterialsbmrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_of_materialsbmr', function (Blueprint $table) {
            $table->id("billofmaterialbmr_id");
            $table->string("serialNumber");
            $table->string("bom_bmr_code");
            $table->string("bmr_code");
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->string('batch_number');
            $table->unsignedBigInteger('batchType_id');
            $table->foreign('batchType_id')->references('batchType_id')->on('batch_types');
            $table->string('batch_size');
            $table->string('unit_of_measure');
            $table->string('remarks');
            $table->string('preparedBy');
            $table->date('preparedOn');
            $table->string('approvedBy');
            $table->date('approvedDate');
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
        Schema::dropIfExists('bill_of_materialsbmr');
    }
}
