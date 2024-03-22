<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialReceives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_receives', function (Blueprint $table) {
            $table->id('material_receive_id');
            $table->string('serialNumber');
            $table->string('mrrCode');
            $table->string('poNumber');
            $table->string('vendorNumber');
            $table->unsignedBigInteger('material_record_id');
            $table->foreign('material_record_id')->references('material_record_id')->on('material_record_entries');
            $table->string('unitOfMeasuring');
            $table->string('supplier');
            $table->string('batchNo');
            $table->date('mfgDate');
            $table->date('expDate');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('location_id')->on('locations');
            $table->integer('totalQuantity');
            $table->integer('numberOfPackage');
            $table->string('deliveryChallanNumber');
            $table->string('coaAttached');
            $table->integer('materialControlNumber');
            $table->integer('quantityReceived');
            $table->integer('quantityRejected');
            $table->integer('damagedQuantity')->nullable();
            $table->string('preparedBy');
            $table->date('date');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('material_receives');
    }
}
