<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsReceivingNote extends Model
{
    use HasFactory;

    protected $table = 'goods_receiving_notes';
    protected $primaryKey = 'goods_receiving_id';
    protected $fillable = [
        'serialNumber',
        'grnCode',
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
        return $this->belongsTo('App\Models\MaterialRecordEntry', 'material_record_id');
    }

    function getWarehouseLocation(){
        return $this->belongsTo('App\Models\Location', 'location_id');
    }
}
