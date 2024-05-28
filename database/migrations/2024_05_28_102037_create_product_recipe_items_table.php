<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRecipeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_recipe_items', function (Blueprint $table) {
            $table->id('recipe_item_id');
            $table->unsignedBigInteger('product_recipe_id',);
            $table->foreign('product_recipe_id')->references('product_recipe_id')->on('product_recipes');
            $table->unsignedBigInteger('material_record_id',);
            $table->foreign('material_record_id')->references('material_record_id')->on('material_record_entries');
            $table->string("materialType");
            $table->integer("quantity");
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
        Schema::dropIfExists('product_recipe_items');
    }
}
