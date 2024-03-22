<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReceive extends Model
{
    use HasFactory;

    protected $table = 'material_receives';
    protected $primaryKey = 'material_receive_id';
    protected $fillable = [
        'serialNumber',
        'mrrCode',
        'poNumber',
        'vendorNumber',
        'material_record_id',
        'unitOfMeasuring',
        'supplier',
        'batchNo',
        'mfgDate',
        'expDate',
        'location_id',
        'totalQuantity',
        'numberOfPackage',
        'deliveryChallanNumber',
        'coaAttached',
        'materialControlNumber',
        'quantityReceived',
        'quantityRejected',
        'damagedQuantity',
        'preparedBy',
        'date',
        'remarks'
    ];


    function getMaterialItem(){
        return $this->hasOne('App\Models\MaterialRecordEntry', 'material_record_id');
    }

    function getWarehoseLocation(){
        return $this->hasOne('App\Models\Location', 'location_id');
    }
}
