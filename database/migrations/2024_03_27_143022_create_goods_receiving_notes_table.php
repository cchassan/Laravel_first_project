<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsReceivingNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_receiving_notes', function (Blueprint $table) {
            $table->id('goods_receiving_id');
            $table->string('serialNumber',255);
            $table->string('grnCode', 255);
            $table->string('poNumber',255);
            $table->string('vendorNumber',255);
            $table->unsignedBigInteger('material_record_id',);
            $table->foreign('material_record_id')->references('material_record_id')->on('material_record_entries');
            $table->string('unitOfMeasuring',255);
            $table->string('supplier',255);
            $table->string('batchNo',255);
            $table->date('mfgDate');
            $table->date('expDate');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('location_id')->on('locations');
            $table->integer('totalQuantity');
            $table->integer('numberOfPackage');
            $table->string('deliveryChallanNumber',255);
            $table->string('coaAttached');
            $table->integer('materialControlNumber');
            $table->integer('quantityReceived');
            $table->integer('quantityRejected');
            $table->integer('damagedQuantity')->nullable();
            $table->string('preparedBy',255);
            $table->date('date');
            $table->string('remarks',500)->nullable();
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
        Schema::dropIfExists('goods_receiving_notes');
    }
}
