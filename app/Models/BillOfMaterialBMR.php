<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillOfMaterialBMR extends Model
{
    use HasFactory;

    protected $primaryKey = 'billofmaterialbmr_id';
    protected  $table = 'bill_of_materialsbmr';

    protected $fillable = [
        'serialNumber',
        'bom_bmr_code',
        'bmr_code',
        'productId',
        'batch_number',
        'batchTypeId',
        'batchSize',
        'measurementUnit',
        'remarks',
        'preparedBy',
        'preparedOn',
        'approvedBy',
        'approvedDate',
    ];


    function getProduct(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    function getMaterialItem(){
        return $this->belongsTo('App\Models\MaterialRecordEntry', 'material_record_id');
    }
}
