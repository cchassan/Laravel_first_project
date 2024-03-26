<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialRecordEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_record_entries', function (Blueprint $table) {
            $table->id('material_record_id');
            $table->string('serialNumber', 255);
            $table->string('itemCode', 255);
            $table->string('itemDescription', 500);
            $table->string('manufacturerName',255);
            $table->string('manufacturerAddress',500);
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
        Schema::dropIfExists('material_record_entries');
    }
}
