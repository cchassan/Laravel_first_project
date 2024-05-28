<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecipeItem extends Model
{
    use HasFactory;

    protected $table = 'product_recipe_items';
    protected $primaryKey = 'recipe_item_id';
    protected $fillable = [
        'materialRecordId',
        'materialType',
        'quantity',
        'unitOfMeasuring',
    ];

    function getMaterialItem(){
        return $this->belongsTo('App\Models\MaterialRecordEntry', 'material_record_id');
    }
}
