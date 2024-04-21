<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id("product_id");
            $table->string("serialNumber");
            $table->string("product_code");
            $table->string("product_name");
            $table->string("generic_name");
            $table->string("strength");
            $table->string("fill_volume");
            $table->integer("batch_size_liter");
            $table->integer("batch_size_vial");
            $table->unsignedBigInteger('routeAdministration_id');
            $table->foreign('routeAdministration_id')->references('routeAdministration_id')->on('route_administrations');
            $table->unsignedBigInteger('secondaryPackagingFormat_id');
            $table->foreign('secondaryPackagingFormat_id')->references('secondaryPackagingFormat_id')->on('secondary_packaging_formats');
            $table->string('preparedBy');
            $table->string('addedBy');
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
        Schema::dropIfExists('products');
    }
}
