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
            $table->id();
            $table->string('serialNumber');
            $table->string('itemCode');
            $table->string('itemDescription');
            $table->string('manufacturerName');
            $table->string('manufacturerAddress');
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
        Schema::dropIfExists('material_record_entries');
    }
}
