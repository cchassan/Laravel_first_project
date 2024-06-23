<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMaterialBMR extends Model
{
    use HasFactory;

    protected $table = 'request_materials_bmr';
    protected $primaryKey = 'request_materials_bmr_id';

    protected $fillable = [
        'materialRecordId',
        'specification',
        'standardQuantity',
        'requiredQuantity',
        'unitOfMeasuring',
    ];

    function getMaterialItem(){
        return $this->belongsTo('App\Models\MaterialRecordEntry', 'material_record_id');
    }
}
