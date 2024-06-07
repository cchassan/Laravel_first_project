<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecipe extends Model
{
    use HasFactory;

    protected $table = 'product_recipes';
    protected $primaryKey = 'product_recipe_id';

    protected $fillable = [
        'serialNumber',
        'productRecipeCode',
        'productId',
        'preparedBy',
    ];

    function getProduct(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    function getProductRecipeItems(){
        return $this->hasMany('App\Models\ProductRecipeItem', 'product_recipe_id');
    }

    function getMaterialItem(){
        return $this->belongsTo('App\Models\MaterialRecordEntry', 'material_record_id');
    }

}
